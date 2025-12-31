@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')

@section('content')

@if(session('success'))
<div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative">
    <strong class="font-bold">Berhasil!</strong>
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                <x-heroicon-o-building-library class="w-5 h-5 mr-2 text-blue-600" />
                Identitas Sekolah
            </h3>

            <div class="space-y-4">
                <div class="flex items-start gap-4 mb-4 bg-blue-50 p-4 rounded-lg">
                    <div
                        class="w-32 h-16 bg-white border border-gray-200 flex items-center justify-center overflow-hidden shrink-0">
                        @if(isset($settings['document_header']))
                        <img src="{{ asset('images/' . $settings['document_header']) }}" alt="Kop"
                            class="w-full h-full object-contain">
                        @else
                        <span class="text-xs text-gray-400">Belum ada</span>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gambar Kop Surat (Opsional)</label>
                        <p class="text-xs text-gray-500 mb-2">
                            Jika diupload, gambar ini akan <b>menggantikan</b> Header (Logo + Nama Sekolah) di PDF.
                            <br>Ukuran disarankan: <strong>800x150 px</strong>.
                        </p>
                        <input type="file" name="document_header"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition cursor-pointer" />
                    </div>
                </div>
                <div class="flex items-start gap-4 mb-4 bg-blue-50 p-4 rounded-lg">
                    <div
                        class="w-16 h-16 bg-white rounded-full border border-gray-200 flex items-center justify-center overflow-hidden shrink-0">
                        <img src="{{ asset('images/' . ($settings['app_logo'] ?? 'default.png')) }}" alt="Logo"
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Logo Sekolah</label>
                        <p class="text-xs text-gray-500 mb-2">Format: JPG/PNG. Digunakan untuk Header Laporan PDF.</p>
                        <input type="file" name="app_logo"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition cursor-pointer" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Sekolah</label>
                    <input type="text" name="school_name"
                        value="{{ old('school_name', $settings['school_name'] ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                    <textarea name="school_address" rows="3"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('school_address', $settings['school_address'] ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                        <input type="text" name="school_phone"
                            value="{{ old('school_phone', $settings['school_phone'] ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Resmi</label>
                        <input type="email" name="school_email"
                            value="{{ old('school_email', $settings['school_email'] ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 h-fit">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                <x-heroicon-o-cog-6-tooth class="w-5 h-5 mr-2 text-blue-600" />
                Konfigurasi PPDB
            </h3>

            <div class="space-y-4">

                <div class="flex items-center justify-between bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                    <div>
                        <span class="font-bold text-gray-800 text-sm">Status Pendaftaran</span>
                        <p class="text-xs text-gray-500">Jika dimatikan, form pendaftaran di halaman depan akan ditutup.
                        </p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_registration_open" class="sr-only peer" {{
                            ($settings['is_registration_open'] ?? false)==true ? 'checked' : '' }}>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajaran</label>
                    <input type="text" name="academic_year"
                        value="{{ old('academic_year', $settings['academic_year'] ?? '') }}" placeholder="2025/2026"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <input type="date" name="registration_start_date"
                            value="{{ old('registration_start_date', $settings['registration_start_date'] ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm cursor-pointer">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                        <input type="date" name="registration_end_date"
                            value="{{ old('registration_end_date', $settings['registration_end_date'] ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm cursor-pointer">
                    </div>
                </div>

            </div>

            <h3 class="text-lg font-bold text-gray-800 mt-5 mb-4 flex items-center border-b pb-2">
                <x-heroicon-o-link class="w-5 h-5 mr-2 text-blue-600" />
                Link Ujian/Tes
            </h3>

            <div class="space-y-4">

                <div class="bg-blue-50 border border-blue-100 rounded-md p-3 mb-4">
                    <p class="text-xs text-blue-700">
                        <x-heroicon-o-information-circle class="w-4 h-4 inline mr-1" />
                        Link ini akan ditampilkan di halaman <b>Ujian/Tes</b> untuk calon siswa mengikuti ujian online.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Link Tes Multiple Intelligence</label>
                    <input type="url" name="exam_link_1"
                        value="{{ old('exam_link_1', $settings['exam_link_1'] ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                        placeholder="Tes Kompas Bakat: Temukan Kekuatan Unik Anda & Potensi Sejati">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Link Tes Pilihan Jurusan</label>
                    <input type="url" name="exam_link_2"
                        value="{{ old('exam_link_2', $settings['exam_link_2'] ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                        placeholder="Jurusan mana yang seharusnya Saya ambil? (a.k.a Jurusan mana yang seharusnya Saya pilih?)">
                </div>

            </div>

            <h3 class="text-lg font-bold text-gray-800  mt-5 mb-4 flex items-center border-b pb-2">
                <x-heroicon-o-users class="w-5 h-5 mr-2 text-blue-600" />
                Data Panitia
            </h3>

            <div class="space-y-4">

                <div class="bg-blue-50 border border-blue-100 rounded-md p-3 mb-4">
                    <p class="text-xs text-blue-700">
                        <x-heroicon-o-information-circle class="w-4 h-4 inline mr-1" />
                        Data ini akan ditampilkan pada kolom tanda tangan di <b>Cetak Bukti Pendaftaran</b>.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ketua Panitia</label>
                    <input type="text" name="committee_head_name"
                        value="{{ old('committee_head_name', $settings['committee_head_name'] ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                        placeholder="Contoh: Drs. H. Ahmad Fauzi, M.Pd">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIP Ketua Panitia</label>
                    <input type="text" name="committee_head_nip"
                        value="{{ old('committee_head_nip', $settings['committee_head_nip'] ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                        placeholder="Contoh: 19800101 200501 1 001">
                </div>

            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button type="submit"
            class="bg-blue-600 text-white px-6 py-2.5 rounded-md hover:bg-blue-700 transition font-bold shadow-lg flex items-center">
            <x-heroicon-o-check-circle class="w-5 h-5 mr-2" />
            Simpan Pengaturan
        </button>
    </div>

</form>
@endsection
