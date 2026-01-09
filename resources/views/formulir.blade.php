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

                <div class="hidden md:flex items-center space-x-4 relative z-10">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition cursor-pointer">
                        <x-heroicon-o-home class="w-4 h-4 mr-1" />
                        Beranda
                    </a>
                    <a href="{{ route('formulir') }}"
                        class="text-sm font-medium {{ request()->routeIs('formulir') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition cursor-pointer">
                        <x-heroicon-o-pencil-square class="w-4 h-4 mr-1" />
                        Formulir
                    </a>
                    <a href="{{ route('registration.check-status.form') }}"
                        class="text-sm font-medium {{ request()->routeIs('registration.check-status.form') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition cursor-pointer">
                        <x-heroicon-o-clipboard-document-check class="w-4 h-4 mr-1" />
                        Cek Status
                    </a>
                    <a href="{{ route('ujian-tes') }}"
                        class="text-sm font-medium {{ request()->routeIs('ujian-tes') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition cursor-pointer">
                        <x-heroicon-o-document-text class="w-4 h-4 mr-1" />
                        Tes Minat & Bakat
                    </a>
                    <a href="{{ route('pengumuman-seleksi') }}"
                        class="text-sm font-medium {{ request()->routeIs('pengumuman-seleksi') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition cursor-pointer">
                        <x-heroicon-o-academic-cap class="w-4 h-4 mr-1" />
                        Pengumuman Seleksi
                    </a>
                    
                </div>

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
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-home class="w-5 h-5 mr-2" />
                        Beranda
                    </div>
                </a>
                <a href="{{ route('formulir') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('formulir') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-pencil-square class="w-5 h-5 mr-2" />
                        Formulir
                    </div>
                </a>
                <a href="{{ route('registration.check-status.form') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('registration.check-status.form') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-clipboard-document-check class="w-5 h-5 mr-2" />
                        Cek Status
                    </div>
                </a>
                <a href="{{ route('ujian-tes') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('ujian-tes') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-document-text class="w-5 h-5 mr-2" />
                        Tes Minat & Bakat
                    </div>
                </a>
                <a href="{{ route('pengumuman-seleksi') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('pengumuman-seleksi') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" />
                        Pengumuman Seleksi
                    </div>
                </a>
                
            </div>
        </div>
    </nav>

    {{-- Page Header --}}
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
                      registrationPath: '{{ old('registration_path', '') }}',
                      prestasiAkademik: [
                          { semester: 1, peringkat: '{{ old('prestasi_akademik.0.peringkat', '') }}', keterangan: '{{ old('prestasi_akademik.0.keterangan', '') }}' },
                          { semester: 2, peringkat: '{{ old('prestasi_akademik.1.peringkat', '') }}', keterangan: '{{ old('prestasi_akademik.1.keterangan', '') }}' },
                          { semester: 3, peringkat: '{{ old('prestasi_akademik.2.peringkat', '') }}', keterangan: '{{ old('prestasi_akademik.2.keterangan', '') }}' },
                          { semester: 4, peringkat: '{{ old('prestasi_akademik.3.peringkat', '') }}', keterangan: '{{ old('prestasi_akademik.3.keterangan', '') }}' },
                          { semester: 5, peringkat: '{{ old('prestasi_akademik.4.peringkat', '') }}', keterangan: '{{ old('prestasi_akademik.4.keterangan', '') }}' },
                                       ],
                      prestasiNonAkademik: [{ nama_lomba: '', tingkat: '', peringkat: '', tahun: '' }],
                      addPrestasiNonAkademik() {
                          this.prestasiNonAkademik.push({ nama_lomba: '', tingkat: '', peringkat: '', tahun: '' });
                      },
                      removePrestasiNonAkademik(index) {
                          if (this.prestasiNonAkademik.length > 1) {
                              this.prestasiNonAkademik.splice(index, 1);
                          }
                      },
                      get average() {
                          return ((Number(this.mtk) + Number(this.indo) + Number(this.ing) + Number(this.ipa)) / 4).toFixed(2);
                      }
                  }">
                @csrf

                {{-- Session Error (dari exception atau 403) --}}
                @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-md shadow-sm">
                    <div class="flex items-center">
                        <x-heroicon-o-exclamation-triangle class="h-6 w-6 text-red-500 mr-3" />
                        <div>
                            <h3 class="text-sm font-bold text-red-800">Terjadi Kesalahan</h3>
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
                @endif

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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilihan Jurusan 1
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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilihan Jurusan 2
                                <span class="text-red-500">*</span></label>
                            <select name="jurusan2" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Jurusan 2 --</option>
                                @foreach($majors as $major)
                                <option value="{{ $major->id }}" {{ old('jurusan2') == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Pilihan jurusan kedua jika kuota jurusan pertama penuh.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jalur Pendaftaran
                                <span class="text-red-500">*</span></label>
                            <select name="registration_path" x-model="registrationPath" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Jalur --</option>
                                <option value="umum">Jalur Umum</option>
                                <option value="prestasi">Jalur Prestasi</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Jalur Prestasi memerlukan bukti prestasi (sertifikat/piagam) dan data prestasi.</p>
                        </div>
                    </div>
                </div>

                {{-- Section: Data Prestasi - Hanya muncul untuk Jalur Prestasi --}}
                <div x-show="registrationPath === 'prestasi'" x-transition:enter="transition ease-out duration-300" 
                     x-transition:enter-start="opacity-0 transform -translate-y-4" 
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl p-6 border border-amber-200">
                    
                   
                    <p class="text-sm text-amber-700 mb-6">Data ini wajib diisi untuk Jalur Prestasi Akademik dan Non-Akademik</p>

                    {{-- Prestasi Akademik: Peringkat Semester 1-6 --}}
                    <div class="mb-6">
                        <h4 class="font-bold text-gray-800 mb-3 flex items-center text-sm">
                            <x-heroicon-o-academic-cap class="w-5 h-5 mr-2 text-blue-600" />
                            Prestasi Akademik Tingkat SMP/MTS (Peringkat Kelas Semester 1-5)
                        </h4>
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600">Semester</th>
                                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600">Peringkat</th>
                                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600">Keterangan/Lomba</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <template x-for="(item, index) in prestasiAkademik" :key="index">
                                        <tr>
                                            <td class="px-4 py-2">
                                                <span class="font-medium text-gray-700" x-text="'Semester ' + item.semester"></span>
                                                <input type="hidden" :name="'prestasi_akademik[' + index + '][semester]'" :value="item.semester">
                                            </td>
                                            <td class="px-4 py-2">
                                                <select :name="'prestasi_akademik[' + index + '][peringkat]'" x-model="item.peringkat"
                                                    class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="1">Peringkat 1</option>
                                                    <option value="2">Peringkat 2</option>
                                                    <option value="3">Peringkat 3</option>
                                                    </select>
                                            </td>
                                            <td class="px-4 py-2">
                                                <input type="text" :name="'prestasi_akademik[' + index + '][keterangan]'" x-model="item.keterangan"
                                                    placeholder="Contoh: Juara kelas"
                                                    class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Prestasi Non-Akademik: Lomba --}}
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-bold text-gray-800 flex items-center text-sm">
                                <x-heroicon-o-star class="w-5 h-5 mr-2 text-yellow-500" />
                                Prestasi Non-Akademik Tingkat SD/MI-SMP/MTS (Lomba/Kejuaraan)
                            </h4>
                            <button type="button" @click="addPrestasiNonAkademik()"
                                class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-xs font-semibold rounded-md hover:bg-green-700 transition">
                                <x-heroicon-o-plus class="w-4 h-4 mr-1" />
                                Tambah Lomba
                            </button>
                        </div>
                        
                        <div class="space-y-3">
                            <template x-for="(lomba, index) in prestasiNonAkademik" :key="index">
                                <div class="bg-white rounded-lg border border-gray-200 p-4 relative">
                                    <button type="button" @click="removePrestasiNonAkademik(index)" 
                                        x-show="prestasiNonAkademik.length > 1"
                                        class="absolute top-2 right-2 p-1 text-red-500 hover:bg-red-50 rounded-full transition">
                                        <x-heroicon-o-x-mark class="w-4 h-4" />
                                    </button>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-medium text-gray-600 mb-1">Nama Lomba/Kejuaraan</label>
                                            <input type="text" :name="'prestasi_non_akademik[' + index + '][nama_lomba]'" x-model="lomba.nama_lomba"
                                                placeholder="Contoh: Lomba Futsal, Pramuka, dll"
                                                class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 mb-1">Tingkat</label>
                                            <select :name="'prestasi_non_akademik[' + index + '][tingkat]'" x-model="lomba.tingkat"
                                                class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                <option value="">-- Pilih --</option>
                                                <option value="kabupaten">Kabupaten/Kota</option>
                                                <option value="provinsi">Provinsi</option>
                                                <option value="nasional">Nasional</option>
                                                <option value="internasional">Internasional</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 mb-1">Peringkat/Juara</label>
                                            <select :name="'prestasi_non_akademik[' + index + '][peringkat]'" x-model="lomba.peringkat"
                                                class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                <option value="">-- Pilih --</option>
                                                <option value="juara_1">Juara 1</option>
                                                <option value="juara_2">Juara 2</option>
                                                <option value="juara_3">Juara 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Tahun</label>
                                        <input type="number" :name="'prestasi_non_akademik[' + index + '][tahun]'" x-model="lomba.tahun"
                                            placeholder="2024" min="2018" max="2026"
                                            class="w-24 text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>
                                </div>
                            </template>
                        </div>
                        
                        <p class="text-xs text-gray-500 mt-3">
                            <x-heroicon-o-information-circle class="w-4 h-4 inline" />
                            Klik "Tambah Lomba" untuk menambahkan lebih banyak prestasi. Pastikan sertifikat/piagam sesuai dengan data yang diisi.
                        </p>
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
                <div x-data="{ selectedSchool: '{{ old('asal_sekolah', '') }}', isOther: {{ old('asal_sekolah_lainnya') ? 'true' : 'false' }} }">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Data Akademik</h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Asal Sekolah
                            <span class="text-red-500">*</span>
                        </label>
                        <select name="asal_sekolah" required x-model="selectedSchool" @change="isOther = (selectedSchool === 'LAINNYA')"
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                            <option value="">-- Pilih Sekolah --</option>
                            <option value="SMPN 1 BANYURESMI" {{ old('asal_sekolah') == 'SMPN 1 BANYURESMI' ? 'selected' : '' }}>SMPN 1 BANYURESMI</option>
                            <option value="SMPN 2 BANYURESMI" {{ old('asal_sekolah') == 'SMPN 2 BANYURESMI' ? 'selected' : '' }}>SMPN 2 BANYURESMI</option>
                            <option value="SMPN 3 BANYURESMI" {{ old('asal_sekolah') == 'SMPN 3 BANYURESMI' ? 'selected' : '' }}>SMPN 3 BANYURESMI</option>
                            <option value="SMPN 1 LEUWIGOONG" {{ old('asal_sekolah') == 'SMPN 1 LEUWIGOONG' ? 'selected' : '' }}>SMPN 1 LEUWIGOONG</option>
                            <option value="SMPN 2 LEUWIGOONG" {{ old('asal_sekolah') == 'SMPN 2 LEUWIGOONG' ? 'selected' : '' }}>SMPN 2 LEUWIGOONG</option>
                            <option value="SMPN 1 CIBIUK" {{ old('asal_sekolah') == 'SMPN 1 CIBIUK' ? 'selected' : '' }}>SMPN 1 CIBIUK</option>
                            <option value="SMPN 2 CIBIUK" {{ old('asal_sekolah') == 'SMPN 2 CIBIUK' ? 'selected' : '' }}>SMPN 2 CIBIUK</option>
                            <option value="SMP ISLAM PERJUANGAN" {{ old('asal_sekolah') == 'SMP ISLAM PERJUANGAN' ? 'selected' : '' }}>SMP ISLAM PERJUANGAN</option>
                            <option value="SMP MUSLIMIN" {{ old('asal_sekolah') == 'SMP MUSLIMIN' ? 'selected' : '' }}>SMP MUSLIMIN</option>
                            <option value="SMP DARUL ASIKIN" {{ old('asal_sekolah') == 'SMP DARUL ASIKIN' ? 'selected' : '' }}>SMP DARUL ASIKIN</option>
                            <option value="SMP DARUL MUKMININ" {{ old('asal_sekolah') == 'SMP DARUL MUKMININ' ? 'selected' : '' }}>SMP DARUL MUKMININ</option>
                            <option value="SMP KARYAMUDA" {{ old('asal_sekolah') == 'SMP KARYAMUDA' ? 'selected' : '' }}>SMP KARYAMUDA</option>
                            <option value="SMP MANGGALA" {{ old('asal_sekolah') == 'SMP MANGGALA' ? 'selected' : '' }}>SMP MANGGALA</option>
                            <option value="SMP AL FALAH" {{ old('asal_sekolah') == 'SMP AL FALAH' ? 'selected' : '' }}>SMP AL FALAH</option>
                            <option value="SMP AL GHIFARI" {{ old('asal_sekolah') == 'SMP AL GHIFARI' ? 'selected' : '' }}>SMP AL GHIFARI</option>
                            <option value="SMP YAKHA" {{ old('asal_sekolah') == 'SMP YAKHA' ? 'selected' : '' }}>SMP YAKHA</option>
                            <option value="SMP NURUL AMIN" {{ old('asal_sekolah') == 'SMP NURUL AMIN' ? 'selected' : '' }}>SMP NURUL AMIN</option>
                            <option value="SMP SALAFIYAH" {{ old('asal_sekolah') == 'SMP SALAFIYAH' ? 'selected' : '' }}>SMP SALAFIYAH</option>
                            <option value="SMP AL HAWARI" {{ old('asal_sekolah') == 'SMP AL HAWARI' ? 'selected' : '' }}>SMP AL HAWARI</option>
                            <option value="MTS PERSIS LEMPONG" {{ old('asal_sekolah') == 'MTS PERSIS LEMPONG' ? 'selected' : '' }}>MTS PERSIS LEMPONG</option>
                            <option value="MTS AL HANAFI" {{ old('asal_sekolah') == 'MTS AL HANAFI' ? 'selected' : '' }}>MTS AL HANAFI</option>
                            <option value="MTS PERSIS PASIRSALAM" {{ old('asal_sekolah') == 'MTS PERSIS PASIRSALAM' ? 'selected' : '' }}>MTS PERSIS PASIRSALAM</option>
                            <option value="MTS BAITUROHMAN" {{ old('asal_sekolah') == 'MTS BAITUROHMAN' ? 'selected' : '' }}>MTS BAITUROHMAN</option>
                            <option value="MTS MUHAMADIYAH BOJONG" {{ old('asal_sekolah') == 'MTS MUHAMADIYAH BOJONG' ? 'selected' : '' }}>MTS MUHAMADIYAH BOJONG</option>
                            <option value="MTS AL FALAH" {{ old('asal_sekolah') == 'MTS AL FALAH' ? 'selected' : '' }}>MTS AL FALAH</option>
                            <option value="MTS SA AL HIDAYAH" {{ old('asal_sekolah') == 'MTS SA AL HIDAYAH' ? 'selected' : '' }}>MTS SA AL HIDAYAH</option>
                            <option value="MTS AL YUSUFIAH" {{ old('asal_sekolah') == 'MTS AL YUSUFIAH' ? 'selected' : '' }}>MTS AL YUSUFIAH</option>
                            <option value="MTS MUHAMADIYAH LIMBANGAN" {{ old('asal_sekolah') == 'MTS MUHAMADIYAH LIMBANGAN' ? 'selected' : '' }}>MTS MUHAMADIYAH LIMBANGAN</option>
                            <option value="MTS ASSALAM" {{ old('asal_sekolah') == 'MTS ASSALAM' ? 'selected' : '' }}>MTS ASSALAM</option>
                            <option value="LAINNYA" {{ old('asal_sekolah') == 'LAINNYA' ? 'selected' : '' }}>-- Lainnya (Isi Dibawah) --</option>
                        </select>
                    </div>
                    
                    {{-- Input Manual jika pilih Lainnya --}}
                    <div class="mb-4" x-show="isOther" x-transition>
                        <label class="block text-sm font-medium text-gray-700">Nama Sekolah
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="asal_sekolah_lainnya" value="{{ old('asal_sekolah_lainnya') }}" 
                            :required="isOther"
                            placeholder="Ketik nama sekolah asal..."
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Tulis nama sekolah lengkap, contoh: SMPN 1 GARUT</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tahun Lulus
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus') }}" required
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                   <!-- <div class="grid grid-cols-2 md:grid-cols-5 gap-4 items-end bg-blue-50 p-4 rounded-lg">
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
                    </div>-->
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
                    <p class="text-sm text-gray-500 mb-4">Upload dokumen dalam format PDF, JPG, atau PNG (maksimal 1MB per file, kecuali Pas Foto dan Sertifikat maks 2MB).</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Kartu Keluarga --}}
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <x-heroicon-o-document-text class="w-4 h-4 inline mr-1" />
                                Kartu Keluarga (KK)
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition bg-gray-50">
                                <input type="file" name="dokumen_kk" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-400 mt-1">Format: PDF/JPG/PNG, Maks: 1MB</p>
                            </div>
                        </div>

                        {{-- KTP Orangtua --}}
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <x-heroicon-o-identification class="w-4 h-4 inline mr-1" />
                                KTP Orangtua
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition bg-gray-50">
                                <input type="file" name="dokumen_ktp" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-400 mt-1">Format: PDF/JPG/PNG, Maks: 1MB</p>
                            </div>
                        </div>

                        {{-- Akta Kelahiran --}}
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <x-heroicon-o-document-text class="w-4 h-4 inline mr-1" />
                                Akta Kelahiran
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition bg-gray-50">
                                <input type="file" name="dokumen_akta" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-400 mt-1">Format: PDF/JPG/PNG, Maks: 1MB</p>
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
                                <input type="file" name="dokumen_ijazah" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-400 mt-1">Format: PDF/JPG/PNG, Maks: 1MB</p>
                            </div>
                        </div>

                        {{-- Kartu Indonesia Pintar (KIP) --}}
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <x-heroicon-o-credit-card class="w-4 h-4 inline mr-1" />
                                Kartu Indonesia Pintar (KIP)
                                <span class="text-xs text-gray-400 font-normal">(Opsional)</span>
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition bg-gray-50">
                                <input type="file" name="dokumen_kip" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                                <p class="text-xs text-gray-400 mt-1">Format: PDF/JPG/PNG, Maks: 1MB (Upload jika memiliki KIP)</p>
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
                            <input type="file" name="dokumen_suratdokter" accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-400 mt-1">Format: PDF/JPG/PNG, Maks: 1MB</p>
                        </div>
                    </div>

                    {{-- Sertifikat / Piagam Prestasi - WAJIB untuk Jalur Prestasi --}}
                    <div class="relative" x-show="registrationPath === 'prestasi'" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <x-heroicon-o-trophy class="w-4 h-4 inline mr-1 text-amber-500" />
                            Sertifikat/ Piagam Prestasi
                            <span class="text-red-500">*</span>
                            <span class="text-xs text-red-500 font-normal">(Wajib untuk Jalur Prestasi)</span>
                        </label>
                        <div class="border-2 border-dashed border-amber-300 rounded-lg p-4 hover:border-amber-500 transition bg-amber-50">
                            <input type="file" name="sertifikat_prestasi" accept=".pdf"
                                :required="registrationPath === 'prestasi'"
                                class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-amber-100 file:text-amber-700 hover:file:bg-amber-200">
                            <p class="text-xs text-amber-600 mt-1">
                                <strong>Format: PDF</strong> (Gabung beberapa sertifikat menjadi 1 file)<br>
                                Maksimal: 2MB
                            </p>
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
        <p>&copy; {{ date('Y') }} {{ \App\Models\Setting::getValue('school_name') }}. alamat: {{ \App\Models\Setting::getValue('school_address') }}.</p>
    </footer>

    {{-- Auto-save Script --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const STORAGE_KEY = 'spmb_formulir_draft';
        const form = document.querySelector('form[action*="registration.store"]');
        
        if (!form) return;
        
        // Daftar field yang akan disimpan (tidak termasuk file dan csrf)
        const fieldsToSave = [
            'name', 'nisn', 'nik', 'birth_place', 'birth_date', 'gender', 'religion',
            'alamat', 'rt', 'rw', 'kode_pos', 'kelurahan', 'kecamatan', 'kota', 'provinsi',
            'phone', 'email', 'asal_sekolah', 'asal_sekolah_lainnya', 'tahun_lulus',
            'nama_ayah', 'pekerjaan_ayah', 'penghasilan_ayah', 'no_hp_ayah',
            'nama_ibu', 'pekerjaan_ibu', 'penghasilan_ibu', 'no_hp_ibu',
            'major_id', 'jurusan2', 'registration_path'
        ];
        
        // Buat indikator status simpan
        const statusIndicator = document.createElement('div');
        statusIndicator.id = 'autosave-status';
        statusIndicator.className = 'fixed bottom-4 left-4 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg text-sm flex items-center space-x-2 z-50 opacity-0 transition-opacity duration-300';
        statusIndicator.innerHTML = `
            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span>Data tersimpan otomatis</span>
        `;
        document.body.appendChild(statusIndicator);
        
        let saveTimeout;
        
        // Fungsi untuk menampilkan indikator
        function showSaveIndicator() {
            statusIndicator.classList.remove('opacity-0');
            statusIndicator.classList.add('opacity-100');
            setTimeout(() => {
                statusIndicator.classList.remove('opacity-100');
                statusIndicator.classList.add('opacity-0');
            }, 2000);
        }
        
        // Fungsi untuk menyimpan data ke localStorage
        function saveFormData() {
            const formData = {};
            
            fieldsToSave.forEach(fieldName => {
                const field = form.querySelector(`[name="${fieldName}"]`);
                if (field) {
                    formData[fieldName] = field.value;
                }
            });
            
            // Simpan timestamp
            formData._savedAt = new Date().toISOString();
            
            localStorage.setItem(STORAGE_KEY, JSON.stringify(formData));
            showSaveIndicator();
        }
        
        // Fungsi untuk memuat data dari localStorage
        function loadFormData() {
            const savedData = localStorage.getItem(STORAGE_KEY);
            if (!savedData) return;
            
            try {
                const formData = JSON.parse(savedData);
                
                // Cek apakah data masih valid (maksimal 7 hari)
                if (formData._savedAt) {
                    const savedDate = new Date(formData._savedAt);
                    const now = new Date();
                    const daysDiff = (now - savedDate) / (1000 * 60 * 60 * 24);
                    
                    if (daysDiff > 7) {
                        localStorage.removeItem(STORAGE_KEY);
                        return;
                    }
                }
                
                // Isi form dengan data tersimpan
                fieldsToSave.forEach(fieldName => {
                    if (formData[fieldName] !== undefined && formData[fieldName] !== '') {
                        const field = form.querySelector(`[name="${fieldName}"]`);
                        if (field && !field.value) {
                            field.value = formData[fieldName];
                            // Trigger change event untuk Alpine.js
                            field.dispatchEvent(new Event('change', { bubbles: true }));
                            field.dispatchEvent(new Event('input', { bubbles: true }));
                        }
                    }
                });
                
                // Tampilkan notifikasi data dimuat
                const loadNotif = document.createElement('div');
                loadNotif.className = 'fixed bottom-4 right-4 bg-blue-600 text-white px-4 py-3 rounded-lg shadow-lg text-sm z-50 flex items-center space-x-3';
                loadNotif.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <strong>Data sebelumnya ditemukan</strong>
                        <p class="text-xs text-blue-200">Form telah diisi dengan data yang tersimpan</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="ml-2 text-white hover:text-blue-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                `;
                document.body.appendChild(loadNotif);
                
                // Hapus notifikasi setelah 5 detik
                setTimeout(() => {
                    if (loadNotif.parentElement) {
                        loadNotif.remove();
                    }
                }, 5000);
                
            } catch (e) {
                console.error('Error loading saved form data:', e);
            }
        }
        
        // Muat data tersimpan saat halaman dimuat
        loadFormData();
        
        // Auto-save saat ada perubahan (dengan debounce 2 detik)
        form.addEventListener('input', function(e) {
            if (e.target.type === 'file') return; // Skip file inputs
            
            clearTimeout(saveTimeout);
            saveTimeout = setTimeout(saveFormData, 2000);
        });
        
        form.addEventListener('change', function(e) {
            if (e.target.type === 'file') return; // Skip file inputs
            
            clearTimeout(saveTimeout);
            saveTimeout = setTimeout(saveFormData, 1000);
        });
        
        // Hapus data tersimpan saat form berhasil di-submit
        form.addEventListener('submit', function() {
            localStorage.removeItem(STORAGE_KEY);
        });
        
        // Tambahkan tombol hapus draft
        const clearDraftBtn = document.createElement('button');
        clearDraftBtn.type = 'button';
        clearDraftBtn.className = 'text-sm text-red-500 hover:text-red-700 underline mt-2';
        clearDraftBtn.textContent = 'Hapus data tersimpan (mulai dari awal)';
        clearDraftBtn.onclick = function() {
            if (confirm('Yakin ingin menghapus semua data yang telah diisi?')) {
                localStorage.removeItem(STORAGE_KEY);
                location.reload();
            }
        };
        
        // Sisipkan tombol sebelum tombol submit
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.parentElement.insertBefore(clearDraftBtn, submitBtn);
        }
    });
    </script>

</body>

</html>

