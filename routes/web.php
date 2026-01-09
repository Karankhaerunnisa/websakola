<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\MitraSmkController;
use App\Http\Controllers\PengumumanujianController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrantController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\FrontRegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeController;

// Storage File Serving Route (untuk hosting yang tidak support symbolic link)
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    
    if (!file_exists($filePath)) {
        abort(404);
    }
    
    $mimeType = mime_content_type($filePath);
    
    return Response::file($filePath, [
        'Content-Type' => $mimeType,
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*')->name('storage.serve');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/formulir', [HomeController::class, 'formulir'])->name('formulir');

// Public Pages - Alumni, Prestasi, Ekskul, Kegiatan, Mitra
Route::get('/alumni', [HomeController::class, 'alumni'])->name('alumni');
Route::get('/prestasi', [HomeController::class, 'prestasi'])->name('prestasi');
Route::get('/ekskul', [HomeController::class, 'ekskul'])->name('ekskul');
Route::get('/kegiatan', [HomeController::class, 'kegiatan'])->name('kegiatan');
Route::get('/mitra', [HomeController::class, 'mitra'])->name('mitra');
Route::get('/tentang-kami', [HomeController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/bursa-kerja', [HomeController::class, 'bursaKerja'])->name('bursa-kerja');
Route::get('/jurusan/{major}', [HomeController::class, 'showJurusan'])->name('jurusan.show');

Route::get('/pengumuman/{announcement}', [HomeController::class, 'showAnnouncement'])->name('announcement.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/registrants/export', [RegistrantController::class, 'export'])->name('registrants.export');
    Route::apiResource('/registrants', RegistrantController::class);
    Route::get('/registrants/{registrant}/print', [RegistrantController::class, 'print'])->name('registrants.print');
    Route::delete('/registrants/{registrant}/exam-result', [RegistrantController::class, 'deleteExamResult'])->name('registrants.delete-exam-result');

    Route::Resource('/majors', MajorController::class)->except(['create', 'edit', 'show']);
    Route::get('/majors/{major}/edit-content', [MajorController::class, 'editContent'])->name('majors.edit-content');
    Route::put('/majors/{major}/update-content', [MajorController::class, 'updateContent'])->name('majors.update-content');

    Route::Resource('/announcements', AnnouncementController::class)->except(['create', 'edit', 'show']);

    Route::Resource('/pengumuman-ujian', PengumumanujianController::class);
    Route::get('/pengumuman-ujian/{pengumuman_ujian}/print', [PengumumanujianController::class, 'print'])->name('pengumuman-ujian.print');

    // Admin CRUD - Alumni, Prestasi, Ekskul, Kegiatan, Mitra
    Route::resource('/alumni', AlumniController::class)->except(['create', 'edit', 'show']);
    Route::resource('/prestasi', PrestasiController::class)->except(['create', 'edit', 'show']);
    Route::resource('/ekskul', EkskulController::class)->except(['create', 'edit', 'show']);
    Route::resource('/kegiatan', KegiatanController::class)->except(['create', 'edit', 'show']);
    Route::resource('/mitra', MitraSmkController::class)->except(['create', 'edit', 'show']);

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});

// Form Submission
Route::post('/register-student', [FrontRegistrationController::class, 'store'])->name('registration.store');

// Success Page
Route::get('/registration/success/{number}', [FrontRegistrationController::class, 'success'])->name('registration.success');

// Public Print Route
Route::get('/registration/print/{number}', [FrontRegistrationController::class, 'print'])
    ->name('registration.print');

Route::get('/check-status', [FrontRegistrationController::class, 'checkStatusForm'])->name('registration.check-status.form');
Route::post('/check-status', [FrontRegistrationController::class, 'checkStatus'])->name('registration.check-status');
Route::post('/check-exam-status', [FrontRegistrationController::class, 'checkExamStatus'])->name('registration.check-exam-status');
Route::post('/api/check-exam-status', [FrontRegistrationController::class, 'checkExamStatusAjax'])->name('registration.check-exam-status.ajax');
Route::post('/upload-documents', [FrontRegistrationController::class, 'uploadDocuments'])->name('registration.upload-documents');

// Pengumuman Seleksi Public Page
Route::get('/pengumuman-seleksi', [HomeController::class, 'pengumumanSeleksi'])->name('pengumuman-seleksi');
Route::post('/pengumuman-seleksi', [HomeController::class, 'checkPengumumanSeleksi'])->name('pengumuman-seleksi.check');
Route::get('/pengumuman-seleksi/cetak/{pengumuman}', [HomeController::class, 'cetakKelulusan'])->name('pengumuman-seleksi.cetak');

// Ujian/Tes Public Page
Route::get('/ujian-tes', [HomeController::class, 'ujianTes'])->name('ujian-tes');
Route::post('/ujian-tes/upload', [HomeController::class, 'uploadExamResult'])->name('ujian-tes.upload');
Route::post('/api/check-registrant', [HomeController::class, 'checkRegistrant'])->name('api.check-registrant');

require __DIR__ . '/auth.php';

