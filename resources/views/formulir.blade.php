<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Pendaftaran - {{ \App\Models\Setting::getValue('school_name') }}</title>
    <meta name="description" content="Formulir pendaftaran siswa baru {{ \App\Models\Setting::getValue('school_name') }} - SPMB Online {{ \App\Models\Setting::getValue('academic_year') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    {{-- Navigation --}}
    <nav x-data="{ open: false }" class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/' . \App\Models\Setting::getValue('app_logo', 'default.png')) }}"
                            class="h-10 w-auto" alt="Logo">
                        <div>
                            <div class="font-bold text-blue-900 leading-tight">
                                {{ \App\Models\Setting::getValue('school_name') }}
                            </div>
                            <div class="text-xs text-gray-500">
                                SPMB Online {{ \App\Models\Setting::getValue('academic_year') }}
                            </div>
                        </div>
                    </a>
                </div>

                <!--<div class="hidden md:flex items-center space-x-4 relative z-10">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium text-gray-600 hover:text-blue-600 flex items-center transition cursor-pointer">
                        <x-heroicon-o-home class="w-4 h-4 mr-1" />
                        Beranda
                    </a>
                    <a href="{{ route('formulir') }}"
                        class="text-sm font-medium text-blue-600 flex items-center transition cursor-pointer">
                        <x-heroicon-o-pencil-square class="w-4 h-4 mr-1" />
                        Formulir
                    </a>
                    <a href="{{ route('registration.check-status.form') }}"
                        class="text-sm font-medium text-gray-600 hover:text-blue-600 flex items-center transition cursor-pointer">
                        <x-heroicon-o-clipboard-document-check class="w-4 h-4 mr-1" />
                        Cek Status
                    </a>
                    <a href="{{ route('ujian-tes') }}"
                        class="text-sm font-medium text-gray-600 hover:text-blue-600 flex items-center transition cursor-pointer">
                        <x-heroicon-o-document-text class="w-4 h-4 mr-1" />
                        Tes Minat & Bakat
                    </a>
                    <a href="{{ route('pengumuman-seleksi') }}"
                        class="text-sm font-medium text-gray-600 hover:text-blue-600 flex items-center transition cursor-pointer">
                        <x-heroicon-o-academic-cap class="w-4 h-4 mr-1" />
                        Pengumuman Seleksi
                    </a>
                    <a href="/login"
                        class="text-sm font-medium bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 flex items-center transition cursor-pointer">
                        <x-heroicon-o-lock-closed class="w-4 h-4 mr-1" />
                        Login
                    </a>
                </div>-->

                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">

                        <x-heroicon-o-bars-3 class="h-6 w-6" x-show="!open" />

                        <x-heroicon-o-x-mark class="h-6 w-6" x-show="open" style="display: none;" />
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden border-t border-gray-100 bg-white"
            style="display: none;">

            <div class="pt-2 pb-3 space-y-1 px-4">
                <a href="{{ route('home') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">
                    <div class="flex items-center">
                        <x-heroicon-o-home class="w-5 h-5 mr-2" />
                        Beranda
                    </div>
                </a>
                <a href="{{ route('formulir') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-blue-600 bg-blue-50 transition">
                    <div class="flex items-center">
                        <x-heroicon-o-pencil-square class="w-5 h-5 mr-2" />
                        Formulir
                    </div>
                </a>
                <a href="{{ route('registration.check-status.form') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">
                    <div class="flex items-center">
                        <x-heroicon-o-clipboard-document-check class="w-5 h-5 mr-2" />
                        Cek Status
                    </div>
                </a>
                <a href="{{ route('ujian-tes') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">
                    <div class="flex items-center">
                        <x-heroicon-o-document-text class="w-5 h-5 mr-2" />
                        Tes Minat & Bakat
                    </div>
                </a>
                <a href="{{ route('pengumuman-seleksi') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">
                    <div class="flex items-center">
                        <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" />
                        Pengumuman Seleksi
                    </div>
                </a>
                
            </div>
        </div>
    </nav>

    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-12 text-white">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-3">Formulir Pendaftaran</h1>
            <p class="text-blue-100 text-lg">SPMB Online {{ \App\Models\Setting::getValue('academic_year') }}</p>
            
            @if($isOpen)
            <div class="mt-4 inline-flex items-center bg-green-500 text-white px-4 py-2 rounded-full font-bold shadow-lg">
                <x-heroicon-o-check-circle class="w-5 h-5 mr-2" />
                Pendaftaran Dibuka
            </div>
            @else
            <div class="mt-4 inline-flex items-center bg-red-500 text-white px-4 py-2 rounded-full font-bold shadow-lg">
                <x-heroicon-o-x-circle class="w-5 h-5 mr-2" />
                Pendaftaran Ditutup
            </div>
            @endif
        </div>
    </div>

    {{-- Main Content --}}
    @if($isOpen)
    <div class="max-w-4xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-blue-600 px-6 py-4 border-b border-blue-500">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <x-heroicon-o-pencil-square class="w-6 h-6 mr-2" />
                    Formulir Pendaftaran
                </h2>
                <p class="text-blue-100 text-sm mt-1">Isi data dengan benar sesuai Ijazah/KK.</p>
            </div>

            <form action="{{ route('registration.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8" x-data="{
                      mtk: 0, indo: 0, ing: 0, ipa: 0,
                      get average() {
                          return ((Number(this.mtk) + Number(this.indo) + Number(this.ing) + Number(this.ipa)) / 4).toFixed(2);
                      }
                  }">
                @csrf

                @if ($errors->any())
                <div id="form-errors"
                    class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-md shadow-sm scroll-mt-24">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <x-heroicon-o-x-circle class="h-6 w-6 text-red-500" />
                        </div>
                        <div class="ml-3 w-full">
                            <h3 class="text-sm font-bold text-red-800">
                                Mohon perbaiki kesalahan berikut:
                            </h3>
                            <ul class="mt-2 list-disc list-inside text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
            const errorBox = document.getElementById('form-errors');
            if (errorBox) {
                errorBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
                </script>
                @endif

                {{-- Section: Pilihan Jurusan & Jalur --}}
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Pilihan Jurusan & Jalur Pendaftaran</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilihan Jurusan
                                <span class="text-red-500">*</span></label>
                            <select name="major_id" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($majors as $major)
                                <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>{{ $major->name }} (Sisa: {{ $major->quota -
                                    $major->registrants_count }})</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Jurusan yang Anda pilih menjadi pertimbangan, keputusan akhir ditentukan oleh panitia seleksi.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jalur Pendaftaran
                                <span class="text-red-500">*</span></label>
                            <select name="registration_path" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Jalur --</option>
                                <option value="umum" {{ old('registration_path') == 'umum' ? 'selected' : '' }}>Jalur Umum</option>
                                <option value="prestasi" {{ old('registration_path') == 'prestasi' ? 'selected' : '' }}>Jalur Prestasi</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Jalur Prestasi memerlukan bukti prestasi (sertifikat/piagam).</p>
                        </div>
                    </div>
                </div>

                {{-- Section: Data Diri --}}
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Data Diri</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NISN
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nisn" value="{{ old('nisn') }}" maxlength="10"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIK
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tempat Lahir
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="birth_place" value="{{ old('birth_place') }}" required
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" required
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="gender" required
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                                @foreach(\App\Enums\Gender::cases() as $g)
                                <option value="{{ $g->value }}" {{ old('gender') == $g->value ? 'selected' : '' }}>{{ $g->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Agama
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="religion" required
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                                @foreach(\App\Enums\Religion::cases() as $r)
                                <option value="{{ $r->value }}" {{ old('religion') == $r->value ? 'selected' : '' }}>{{ $r->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Section: Alamat & Kontak --}}
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Alamat & Kontak</h3>
                    <div class="grid grid-cols-1 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat Lengkap (Jalan/Dusun) <span
                                    class="text-red-500">*</span></label>
                            <textarea name="alamat" rows="2" required
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">{{ old('alamat') }}</textarea>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RT</label>
                                <input type="text" name="rt" value="{{ old('rt') }}" maxlength="3"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RW</label>
                                <input type="text" name="rw" value="{{ old('rw') }}" maxlength="3"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kode Pos
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="kode_pos" value="{{ old('kode_pos') }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kelurahan / Desa
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="kelurahan" value="{{ old('kelurahan') }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kecamatan
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="kecamatan" value="{{ old('kecamatan') }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kota / Kabupaten
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="kota" value="{{ old('kota') }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Provinsi
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="provinsi" value="{{ old('provinsi') }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No. HP (WhatsApp)
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone') }}" required
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email
                                    <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section: Data Akademik --}}
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Data Akademik</h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Asal Sekolah
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tahun Lulus
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus') }}" required
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 items-end bg-blue-50 p-4 rounded-lg">
                        <div>
                            <label class="text-xs text-gray-600">Matematika</label>
                            <input type="number" name="nilai_matematika" x-model="mtk" step="0.01"
                                class="w-full text-sm rounded border-gray-300">
                        </div>
                        <div>
                            <label class="text-xs text-gray-600">B. Indonesia</label>
                            <input type="number" name="nilai_bahasa_indonesia" x-model="indo" step="0.01"
                                class="w-full text-sm rounded border-gray-300">
                        </div>
                        <div>
                            <label class="text-xs text-gray-600">B. Inggris</label>
                            <input type="number" name="nilai_bahasa_inggris" x-model="ing" step="0.01"
                                class="w-full text-sm rounded border-gray-300">
                        </div>
                        <div>
                            <label class="text-xs text-gray-600">IPA</label>
                            <input type="number" name="nilai_ipa" x-model="ipa" step="0.01"
                                class="w-full text-sm rounded border-gray-300">
                        </div>
                        <div class="text-center col-span-2 md:col-span-1">
                            <div class="text-xs text-gray-500 mb-1">Rata-Rata</div>
                            <div class="font-bold text-xl text-blue-600" x-text="average">0.00</div>
                        </div>
                    </div>
                </div>

                {{-- Section: Data Orang Tua --}}
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Data Orang Tua</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h4 class="font-bold text-blue-800 mb-3">Data Ayah</h4>

                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Nama Ayah
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" required
                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Pekerjaan</label>
                                    <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}"
                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Penghasilan</label>
                                    <select name="penghasilan_ayah"
                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm">
                                        <option value="">-- Pilih --</option>
                                        @foreach(\App\Enums\IncomeRange::cases() as $income)
                                        <option value="{{ $income->value }}" {{ old('penghasilan_ayah') == $income->value ? 'selected' : '' }}>{{ $income->label() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">No. HP Ayah</label>
                                    <input type="text" name="no_hp_ayah" value="{{ old('no_hp_ayah') }}"
                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm">
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h4 class="font-bold text-pink-800 mb-3">Data Ibu</h4>

                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Nama Ibu <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" required
                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Pekerjaan</label>
                                    <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}"
                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Penghasilan</label>
                                    <select name="penghasilan_ibu"
                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm">
                                        <option value="">-- Pilih --</option>
                                        @foreach(\App\Enums\IncomeRange::cases() as $income)
                                        <option value="{{ $income->value }}" {{ old('penghasilan_ibu') == $income->value ? 'selected' : '' }}>{{ $income->label() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">No. HP Ibu</label>
                                    <input type="text" name="no_hp_ibu" value="{{ old('no_hp_ibu') }}"
                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section Upload Dokumen --}}
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Upload Dokumen</h3>
                    <p class="text-sm text-gray-500 mb-4">Upload dokumen dalam format PDF (maksimal 1MB per file). Pas foto bisa berupa PDF, JPG, atau PNG.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Kartu Keluarga --}}
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <x-heroicon-o-document-text class="w-4 h-4 inline mr-1" />
                                Kartu Keluarga (KK)
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition bg-gray-50">
                                <input type="file" name="dokumen_kk" accept=".pdf"
                                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-400 mt-1">Format: PDF, Maks: 1MB</p>
                            </div>
                        </div>

                        {{-- Akta Kelahiran --}}
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <x-heroicon-o-document-text class="w-4 h-4 inline mr-1" />
                                Akta Kelahiran
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition bg-gray-50">
                                <input type="file" name="dokumen_akta" accept=".pdf"
                                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-400 mt-1">Format: PDF, Maks: 1MB</p>
                            </div>
                        </div>

                        {{-- Pas Foto --}}
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <x-heroicon-o-photo class="w-4 h-4 inline mr-1" />
                                Pas Foto (3x4)
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition bg-gray-50">
                                <input type="file" name="dokumen_foto" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                <p class="text-xs text-gray-400 mt-1">Format: PDF/JPG/PNG, Maks: 2MB</p>
                            </div>
                        </div>

                        {{-- Ijazah / SKL --}}
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <x-heroicon-o-academic-cap class="w-4 h-4 inline mr-1" />
                                Ijazah / SKL
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition bg-gray-50">
                                <input type="file" name="dokumen_ijazah" accept=".pdf"
                                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-400 mt-1">Format: PDF, Maks: 1MB</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Surat Keterangan Dokter & Sertifikat --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Surat Keterangan Sehat --}}
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <x-heroicon-o-document-text class="w-4 h-4 inline mr-1" />
                            Surat Keterangan Sehat (Pilihan Jurusan TSM & TKR)
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition bg-gray-50">
                            <input type="file" name="dokumen_suratdokter" accept=".pdf"
                                class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-400 mt-1">Format: PDF, Maks: 1MB</p>
                        </div>
                    </div>

                    {{-- Sertifikat / Piagam Prestasi --}}
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <x-heroicon-o-document-text class="w-4 h-4 inline mr-1" />
                            Sertifikat/ Piagam (Jalur Prestasi)
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition bg-gray-50">
                            <input type="file" name="sertifikat_prestasi" accept=".pdf"
                                class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-400 mt-1">Format: PDF, (gabung beberapa sertifikat menjadi 1 file)<br> Maks: 2MB</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-bold text-lg py-4 rounded-lg hover:bg-blue-700 shadow-lg transition transform hover:-translate-y-1">
                        Kirim Pendaftaran
                    </button>
                </div>

            </form>
        </div>
    </div>
    @else
    {{-- Registration Closed --}}
    <div class="max-w-4xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 text-center py-16 px-8">
            <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-6">
                <x-heroicon-o-x-circle class="w-10 h-10 text-red-500" />
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Pendaftaran Ditutup</h2>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                Mohon maaf, pendaftaran SPMB Online saat ini sedang ditutup. 
                Silakan hubungi pihak sekolah untuk informasi lebih lanjut.
            </p>
            <a href="{{ route('home') }}"
                class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                <x-heroicon-o-arrow-left class="w-5 h-5 mr-2" />
                Kembali ke Beranda
            </a>
        </div>
    </div>
    @endif

    {{-- Footer --}}
    <footer class="bg-gray-900 text-white py-8 mt-12 text-center">
        <p>&copy; {{ date('Y') }} {{ \App\Models\Setting::getValue('school_name') }}. All Rights Reserved.</p>
    </footer>

</body>

</html>
