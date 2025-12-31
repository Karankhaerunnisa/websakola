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

            $registrant->academic()->create([
                'school_name' => $request->asal_sekolah,
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
}
