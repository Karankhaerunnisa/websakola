<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PengumumanujianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontRegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/formulir', [HomeController::class, 'formulir'])->name('formulir');


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

    Route::Resource('/announcements', AnnouncementController::class)->except(['create', 'edit', 'show']);

    Route::Resource('/pengumuman-ujian', PengumumanujianController::class);

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

// Pengumuman Seleksi Public Page
Route::get('/pengumuman-seleksi', [HomeController::class, 'pengumumanSeleksi'])->name('pengumuman-seleksi');
Route::post('/pengumuman-seleksi', [HomeController::class, 'checkPengumumanSeleksi'])->name('pengumuman-seleksi.check');

// Ujian/Tes Public Page
Route::get('/ujian-tes', [HomeController::class, 'ujianTes'])->name('ujian-tes');
Route::post('/ujian-tes/upload', [HomeController::class, 'uploadExamResult'])->name('ujian-tes.upload');

require __DIR__ . '/auth.php';

