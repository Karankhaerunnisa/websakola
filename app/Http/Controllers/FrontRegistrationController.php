<?php

namespace App\Http\Controllers;

use App\Enums\GuardianRelationship;
use App\Enums\RegistrantStatus;
use App\Http\Requests\CheckStatusRequest;
use App\Http\Requests\StoreFrontRegistrationRequest;
use App\Models\Registrant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Pest\Support\Str;

class FrontRegistrationController extends Controller
{
    public function store(StoreFrontRegistrationRequest $request)
    {
        // 1. Generate Registration Number (e.g., PPDB2025XXXX)
        $year = now()->format('Y');
        $random = strtoupper(Str::random(5));
        $regNumber = "PPDB{$year}{$random}";

        try {
            DB::beginTransaction();

            // dd($request->validated('religion'), RegistrantStatus::PENDING);
            // 2. Create Registrant (Main Profile)
            $registrant = Registrant::create([
                'registration_number' => $regNumber,
                'major_id' => $request->major_id,
                'major_id_2' => $request->jurusan2,
                'registration_path' => $request->registration_path,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'nisn' => $request->nisn,
                'nik' => $request->nik,
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'status' => RegistrantStatus::PENDING,
            ]);

            // 3. Create Address
            $registrant->address()->create([
                'street_address' => $request->alamat,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'village' => $request->kelurahan,
                'district' => $request->kecamatan,
                'city' => $request->kota,
                'province' => $request->provinsi,
                'postal_code' => $request->kode_pos,
            ]);

            // 4. Create Academic Record
            $avg = ($request->nilai_matematika + $request->nilai_bahasa_indonesia + $request->nilai_bahasa_inggris + $request->nilai_ipa) / 4;

            // Handle "Lainnya" untuk asal sekolah
            $schoolName = $request->asal_sekolah;
            if ($schoolName === 'LAINNYA' && $request->asal_sekolah_lainnya) {
                $schoolName = strtoupper($request->asal_sekolah_lainnya);
            }

            $registrant->academic()->create([
                'school_name' => $schoolName,
                'graduation_year' => $request->tahun_lulus,
                'math_score' => $request->nilai_matematika,
                'indonesian_score' => $request->nilai_bahasa_indonesia,
                'english_score' => $request->nilai_bahasa_inggris,
                'science_score' => $request->nilai_ipa,
                'average_score' => $avg,
            ]);

            // 5. Create Guardians (Father & Mother)
            // Father
            $registrant->guardians()->create([
                'relationship' => GuardianRelationship::FATHER,
                'name' => $request->nama_ayah,
                'job' => $request->pekerjaan_ayah,
                'income_range' => $request->penghasilan_ayah, // Ensure this matches Enum value!
                'phone' => $request->no_hp_ayah,
            ]);

            // Mother
            $registrant->guardians()->create([
                'relationship' => GuardianRelationship::MOTHER,
                'name' => $request->nama_ibu,
                'job' => $request->pekerjaan_ibu,
                'income_range' => $request->penghasilan_ibu,
                'phone' => $request->no_hp_ibu,
            ]);

            // 6. Upload Documents
            $documentTypes = [
                'dokumen_kk' => 'kartu_keluarga',
                'dokumen_ktp' => 'ktp_orangtua',
                'dokumen_kip' => 'kip',
                'dokumen_akta' => 'akta_kelahiran',
                'dokumen_foto' => 'pas_foto',
                'dokumen_ijazah' => 'ijazah_skl',
                'dokumen_suratdokter' => 'surat_dokter',
                'sertifikat_prestasi' => 'sertifikat_prestasi',
            ];

            foreach ($documentTypes as $inputName => $docType) {
                if ($request->hasFile($inputName)) {
                    $file = $request->file($inputName);
                    $fileName = $regNumber . '_' . $docType . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('documents/' . $regNumber, $fileName, 'public');

                    $registrant->documents()->create([
                        'document_type' => $docType,
                        'file_path' => $filePath,
                        'file_name' => $file->getClientOriginalName(),
                    ]);
                }
            }

            // 7. Save Achievement Data (Only for Jalur Prestasi)
            if ($request->registration_path === 'prestasi') {
                // Save Academic Achievements (Semester Rankings)
                if ($request->has('prestasi_akademik')) {
                    foreach ($request->prestasi_akademik as $akademik) {
                        if (!empty($akademik['peringkat'])) {
                            $registrant->academicAchievements()->create([
                                'semester' => $akademik['semester'],
                                'peringkat' => $akademik['peringkat'],
                                'keterangan' => $akademik['keterangan'] ?? null,
                            ]);
                        }
                    }
                }

                // Save Non-Academic Achievements (Competitions)
                if ($request->has('prestasi_non_akademik')) {
                    foreach ($request->prestasi_non_akademik as $nonAkademik) {
                        if (!empty($nonAkademik['nama_lomba'])) {
                            $registrant->nonAcademicAchievements()->create([
                                'nama_lomba' => $nonAkademik['nama_lomba'],
                                'tingkat' => $nonAkademik['tingkat'] ?? null,
                                'peringkat' => $nonAkademik['peringkat'] ?? null,
                                'tahun' => $nonAkademik['tahun'] ?? null,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            // Redirect to a specific "Success" page with the number
            return redirect()->route('registration.success', $registrant->registration_number);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage())->withInput();
        }
    }

    public function success($number)
    {
        $registrant = Registrant::where('registration_number', $number)->firstOrFail();

        return view('registration-success', compact('registrant'));
    }

    public function print(string $number)
    {
        // Find by Registration Number (Security: Hard to guess)
        $registrant = Registrant::where('registration_number', $number)->firstOrFail();

        // Load necessary data
        $registrant->load(['major', 'address', 'guardians', 'academic']);

        // Reuse the SAME blade file we made for Admins (Don't duplicate code!)
        $pdf = Pdf::loadView('admin.registrants.print', compact('registrant'));

        return $pdf->stream('Bukti-Pendaftaran-' . $registrant->registration_number . '.pdf');
    }

    public function checkStatusForm()
    {
        return view('check-status');
    }

    public function checkStatus(CheckStatusRequest $request)
    {
        $searchValue = $request->validated('registration_number');
        
        $registrant = Registrant::where(function($query) use ($searchValue) {
            $query->where('registration_number', $searchValue)
                  ->orWhere('nisn', $searchValue);
        })
        ->where('birth_date', $request->validated('birth_date'))
        ->with(['major', 'documents'])
        ->first();

        if (! $registrant) {
            return back()->with('error', 'Data pendaftar tidak ditemukan. Silakan periksa kembali Nomor Pendaftaran/NISN dan tanggal lahir Anda.')->withInput();
        } else {
            return view('check-status', compact('registrant'));
        }
    }

    public function checkExamStatus(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'exam_registration_number' => 'required|string',
        ], [
            'exam_registration_number.required' => 'Nomor pendaftaran wajib diisi.',
        ]);

        $registrant = Registrant::where('registration_number', strtoupper($request->exam_registration_number))
            ->with(['examResult'])
            ->first();

        if (! $registrant) {
            return back()->with('exam_error', 'Nomor pendaftaran tidak ditemukan dalam sistem.')->withInput();
        }

        $examResult = $registrant->examResult;

        return view('check-status', [
            'examRegistrant' => $registrant,
            'examResult' => $examResult,
        ]);
    }

    public function checkExamStatusAjax(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'registration_number' => 'required|string',
        ]);

        $registrant = Registrant::where('registration_number', strtoupper($request->registration_number))
            ->with(['examResult'])
            ->first();

        if (! $registrant) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor pendaftaran tidak ditemukan dalam sistem.',
            ]);
        }

        $examResult = $registrant->examResult;

        return response()->json([
            'success' => true,
            'registrant' => [
                'name' => $registrant->name,
                'registration_number' => $registrant->registration_number,
            ],
            'exam_result' => $examResult ? [
                'exam1_image' => $examResult->exam1_image ? asset('storage/exam_results/' . $examResult->exam1_image) : null,
                'exam2_image' => $examResult->exam2_image ? asset('storage/exam_results/' . $examResult->exam2_image) : null,
            ] : null,
        ]);
    }

    public function uploadDocuments(\Illuminate\Http\Request $request)
    {
        // Validate request
        $request->validate([
            'registration_number' => 'required|string',
            'birth_date' => 'required|date',
            'documents' => 'required|array',
            'documents.*' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'documents.required' => 'Silakan pilih minimal satu dokumen untuk diupload.',
            'documents.*.file' => 'File tidak valid.',
            'documents.*.mimes' => 'Format file harus PDF, JPG, atau PNG.',
            'documents.*.max' => 'Ukuran file maksimal 2MB.',
        ]);

        // Find the registrant
        $registrant = Registrant::where('registration_number', $request->registration_number)
            ->where('birth_date', $request->birth_date)
            ->first();

        if (!$registrant) {
            return back()->with('upload_error', 'Data pendaftar tidak ditemukan. Silakan coba lagi.');
        }

        try {
            DB::beginTransaction();

            $documentLabels = [
                'kartu_keluarga' => 'Kartu Keluarga',
                'ktp_orangtua' => 'KTP Orangtua',
                'kip' => 'Kartu Indonesia Pintar (KIP)',
                'akta_kelahiran' => 'Akta Kelahiran',
                'pas_foto' => 'Pas Foto',
                'ijazah_skl' => 'Ijazah / SKL',
                'surat_dokter' => 'Surat Keterangan Sehat',
                'sertifikat_prestasi' => 'Sertifikat Prestasi',
            ];

            $uploadedCount = 0;

            foreach ($request->file('documents') as $docType => $file) {
                // Check if this document type already exists
                $existingDoc = $registrant->documents()->where('document_type', $docType)->first();
                if ($existingDoc) {
                    continue; // Skip if already uploaded
                }

                // Generate filename
                $fileName = $registrant->registration_number . '_' . $docType . '_' . time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('documents/' . $registrant->registration_number, $fileName, 'public');

                // Save to database
                $registrant->documents()->create([
                    'document_type' => $docType,
                    'file_path' => $filePath,
                    'file_name' => $file->getClientOriginalName(),
                ]);

                $uploadedCount++;
            }

            DB::commit();

            if ($uploadedCount > 0) {
                // Reload registrant with updated documents
                $registrant->load(['major', 'documents']);
                
                // Flash success message
                session()->flash('success', $uploadedCount . ' dokumen berhasil diupload.');
                
                return view('check-status', [
                    'registrant' => $registrant,
                ]);
            } else {
                return back()->with('upload_error', 'Tidak ada dokumen baru yang diupload. Semua dokumen mungkin sudah tersedia.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('upload_error', 'Terjadi kesalahan saat mengupload dokumen: ' . $e->getMessage());
        }
    }
}
