<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Alumni;
use App\Models\Ekskul;
use App\Models\ExamResult;
use App\Models\Kegiatan;
use App\Models\Major;
use App\Models\MitraSmk;
use App\Models\Pengumumanujian;
use App\Models\Prestasi;
use App\Models\Registrant;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $isOpen = (bool) Setting::getValue('is_registration_open', false);

        $announcements = Announcement::active()->latest()->take(3)->get();

        $majors = Major::withCount('registrants')->get();

        return view('welcome', compact('isOpen', 'announcements', 'majors'));
    }

    public function formulir()
    {
        $isOpen = (bool) Setting::getValue('is_registration_open', false);
        $majors = Major::withCount('registrants')->get();
        
        // Get active announcements for registration schedule info
        $announcements = Announcement::active()->latest()->get();

        return view('formulir', compact('isOpen', 'majors', 'announcements'));
    }

    public function showAnnouncement(Announcement $announcement)
    {
        if (! $announcement->is_active) {
            abort(404);
        }

        return view('announcement-show', compact('announcement'));
    }

    public function pengumumanSeleksi()
    {
        return view('pengumuman-seleksi');
    }

    public function checkPengumumanSeleksi(Request $request)
    {
        $request->validate([
            'search_key' => 'required|string|max:50',
        ]);

        $searchKey = trim($request->search_key);

        // Search by NISN or registration number
        $registrant = Registrant::where('nisn', $searchKey)
            ->orWhere('registration_number', $searchKey)
            ->first();

        if (!$registrant) {
            return view('pengumuman-seleksi', ['notFound' => true]);
        }

        // Check if announcement exists for this registrant
        $pengumuman = Pengumumanujian::where('registrant_id', $registrant->id)->first();

        if (!$pengumuman) {
            return view('pengumuman-seleksi', ['notFound' => true]);
        }

        // Get exam results if exists
        $examResult = ExamResult::where('registrant_id', $registrant->id)->first();

        $result = [
            'registrant' => $registrant->load('major'),
            'pengumuman' => $pengumuman,
            'status' => $pengumuman->status,
            'examResult' => $examResult,
        ];

        return view('pengumuman-seleksi', compact('result'));
    }

    public function ujianTes(Request $request)
    {
        $examResult = null;
        $registrant = null;

        // Check if registration_number is provided (from query string)
        if ($request->has('registration_number')) {
            $registrant = Registrant::where('registration_number', $request->registration_number)->first();
            if ($registrant) {
                $examResult = ExamResult::where('registrant_id', $registrant->id)->first();
            }
        }

        return view('ujian-tes', compact('examResult', 'registrant'));
        
    }

    public function uploadExamResult(Request $request)
    {
        $request->validate([
            'registration_number' => 'required|string|exists:registrants,registration_number',
            'exam1_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
            'exam2_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
        ], [
            'registration_number.exists' => 'Nomor pendaftaran tidak ditemukan.',
            'exam1_image.required' => 'Screenshot hasil ujian 1 wajib diupload.',
            'exam1_image.image' => 'File ujian 1 harus berupa gambar.',
            'exam1_image.mimes' => 'Format gambar ujian 1 harus JPG, JPEG, atau PNG.',
            'exam1_image.max' => 'Ukuran gambar ujian 1 maksimal 1MB.',
            'exam2_image.required' => 'Screenshot hasil ujian 2 wajib diupload.',
            'exam2_image.image' => 'File ujian 2 harus berupa gambar.',
            'exam2_image.mimes' => 'Format gambar ujian 2 harus JPG, JPEG, atau PNG.',
            'exam2_image.max' => 'Ukuran gambar ujian 2 maksimal 1MB.',
        ]);

        $registrant = Registrant::where('registration_number', $request->registration_number)->first();

        // Check if already uploaded (prevent re-upload)
        $existingResult = ExamResult::where('registrant_id', $registrant->id)->first();
        if ($existingResult && $existingResult->exam1_image && $existingResult->exam2_image) {
            return back()->with('error', 'Anda sudah pernah mengupload hasil tes minat & bakat. Upload hanya dapat dilakukan sekali. Hubungi admin jika ingin mengubah data.');
        }

        // Create new exam result
        $examResult = $existingResult ?? new ExamResult(['registrant_id' => $registrant->id]);

        // Handle exam 1 image
        if ($request->hasFile('exam1_image')) {
            // Delete old image if exists
            if ($examResult->exam1_image) {
                Storage::disk('public')->delete('exam_results/' . $examResult->exam1_image);
            }
            
            $file = $request->file('exam1_image');
            $fileName = $registrant->registration_number . '_exam1_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('exam_results', $fileName, 'public');
            $examResult->exam1_image = $fileName;
        }

        // Handle exam 2 image
        if ($request->hasFile('exam2_image')) {
            // Delete old image if exists
            if ($examResult->exam2_image) {
                Storage::disk('public')->delete('exam_results/' . $examResult->exam2_image);
            }
            
            $file = $request->file('exam2_image');
            $fileName = $registrant->registration_number . '_exam2_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('exam_results', $fileName, 'public');
            $examResult->exam2_image = $fileName;
        }

        $examResult->save();

        return back()->with('success', 'Hasil ujian berhasil diupload! Anda dapat melihat hasilnya di halaman Pengumuman Seleksi.');
    }

    /**
     * API: Check registrant by registration number
     * Returns registrant data if found
     */
    public function checkRegistrant(Request $request)
    {
        $request->validate([
            'registration_number' => 'required|string',
        ]);

        $registrant = Registrant::where('registration_number', $request->registration_number)->first();

        if (!$registrant) {
            return response()->json([
                'found' => false,
                'message' => 'Nomor pendaftaran tidak ditemukan.',
            ]);
        }

        // Check if already uploaded
        $examResult = ExamResult::where('registrant_id', $registrant->id)->first();
        $alreadyUploaded = $examResult && $examResult->exam1_image && $examResult->exam2_image;

        return response()->json([
            'found' => true,
            'data' => [
                'name' => $registrant->name,
                'nisn' => $registrant->nisn,
                'major' => $registrant->major->name ?? '-',
                'already_uploaded' => $alreadyUploaded,
            ],
        ]);
    }

    // Public Pages
    public function alumni()
    {
        $alumni = Alumni::where('is_active', true)->latest()->get();
        return view('alumni', compact('alumni'));
    }

    public function prestasi()
    {
        $prestasi = Prestasi::where('is_active', true)->latest()->get();
        $categories = Prestasi::categories();
        $levels = Prestasi::levels();
        return view('prestasi', compact('prestasi', 'categories', 'levels'));
    }

    public function ekskul()
    {
        $ekskul = Ekskul::where('is_active', true)->latest()->get();
        $categories = Ekskul::categories();
        return view('ekskul', compact('ekskul', 'categories'));
    }

    public function kegiatan()
    {
        $kegiatan = Kegiatan::where('is_active', true)->latest()->get();
        $categories = Kegiatan::categories();
        return view('kegiatan', compact('kegiatan', 'categories'));
    }

    public function mitra()
    {
        $mitra = MitraSmk::where('is_active', true)->latest()->get();
        $categories = MitraSmk::categories();
        $partnershipTypes = MitraSmk::partnershipTypes();
        return view('mitra', compact('mitra', 'categories', 'partnershipTypes'));
    }

    // Tentang Kami Page
    public function tentangKami()
    {
        return view('tentang-kami');
    }

    // Bursa Kerja Khusus (BKK) Page
    public function bursaKerja()
    {
        return view('bursa-kerja');
    }

    // Detail Jurusan Page
    public function showJurusan(Major $major)
    {
        $major->loadCount('registrants');
        $otherMajors = Major::where('id', '!=', $major->id)
            ->where('is_active', true)
            ->get();
        
        return view('jurusan-detail', compact('major', 'otherMajors'));
    }

    /**
     * Cetak Surat Kelulusan Publik
     */
    public function cetakKelulusan(Pengumumanujian $pengumuman)
    {
        $registrant = $pengumuman->registrant()->with(['major', 'academic', 'guardians', 'address'])->first();
        
        if (!$registrant) {
            abort(404, 'Data pendaftar tidak ditemukan');
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pengumumanujian.print-kelulusan', [
            'pengumuman' => $pengumuman,
            'registrant' => $registrant
        ]);

        $pdf->setPaper('A4', 'portrait');

        $filename = 'Surat-Kelulusan-' . $registrant->registration_number . '.pdf';

        return $pdf->stream($filename);
    }
}

