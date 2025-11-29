<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\Setting::getValue('school_name') }} - SPMB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/' . \App\Models\Setting::getValue('app_logo', 'default.png')) }}"
                        class="h-10 w-auto" alt="Logo">
                    <div>
                        <div class="font-bold text-blue-900 leading-tight">{{
                            \App\Models\Setting::getValue('school_name') }}</div>
                        <div class="text-xs text-gray-500">SPMB Online {{ \App\Models\Setting::getValue('academic_year')
                            }}</div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('registration.check-status.form') }}"
                        class="text-sm font-medium text-gray-600 hover:text-blue-600 flex items-center">
                        <x-heroicon-o-magnifying-glass class="w-4 h-4 mr-1" />
                        Cek Status
                    </a>

                    <a href="{{ route('login') }}"
                        class="text-sm font-medium text-gray-600 hover:text-blue-600 flex items-center">
                        <x-heroicon-o-lock-closed class="w-4 h-4 mr-1" />
                        Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="relative bg-blue-900 text-white overflow-hidden">
        <div
            class="absolute inset-0 opacity-20 bg-[url('https://source.unsplash.com/1600x900/?school')] bg-cover bg-center">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Selamat Datang di SPMB Online</h1>
            <p class="text-xl text-blue-100 mb-8">{{ \App\Models\Setting::getValue('school_name') }}</p>

            @if($isOpen)
            <div
                class="inline-flex items-center bg-green-500 text-white px-6 py-2 rounded-full font-bold shadow-lg animate-bounce">
                <x-heroicon-o-check-circle class="w-6 h-6 mr-2" />
                Pendaftaran Dibuka
            </div>
            <div class="mt-8">
                <a href="#register"
                    class="bg-white text-blue-900 px-8 py-3 rounded-md font-bold text-lg hover:bg-gray-100 transition shadow-xl">
                    Daftar Sekarang
                </a>
            </div>
            @else
            <div class="inline-flex items-center bg-red-500 text-white px-6 py-2 rounded-full font-bold shadow-lg">
                <x-heroicon-o-x-circle class="w-6 h-6 mr-2" />
                Pendaftaran Ditutup
            </div>
            @endif
        </div>
    </div>

    @if($announcements->count() > 0)
    <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-center mb-8 text-gray-900">Pengumuman Terbaru</h2>
        <div class="grid gap-6 md:grid-cols-3">
            @foreach($announcements as $news)
            <div class="bg-white p-6 rounded-lg shadow-sm border border-l-4 border-l-blue-500 flex flex-col h-full">
                <div class="text-xs text-gray-500 mb-2 flex items-center">
                    <x-heroicon-o-calendar class="w-3 h-3 mr-1" />
                    {{ $news->published_at->format('d M Y') }}
                </div>

                <h3 class="font-bold text-lg mb-2">
                    <a href="{{ route('announcement.show', $news->id) }}" class="hover:text-blue-600 transition">
                        {{ $news->title }}
                    </a>
                </h3>
                <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-grow">
                    {{ $news->content }}
                </p>
                <div class="mt-auto pt-2">
                    <a href="{{ route('announcement.show', $news->id) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 inline-flex items-center transition">
                        Baca Selengkapnya
                        <x-heroicon-o-arrow-long-right class="w-4 h-4 ml-1" />
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="bg-white py-12 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center mb-8 text-gray-900">Program Keahlian</h2>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                @foreach($majors as $major)
                <div class="p-6 rounded-lg border border-gray-100 hover:shadow-md transition text-center group">
                    <div
                        class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-600 group-hover:text-white transition">
                        <x-heroicon-o-academic-cap class="w-6 h-6" />
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">{{ $major->name }}</h3>
                    <div class="text-sm text-gray-500 mb-3">{{ Str::limit($major->description, 60) }}</div>
                    <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">
                        Sisa Kuota: {{ $major->quota - $major->registrants_count }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @if($isOpen)
    <div id="register" class="max-w-4xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-blue-600 px-6 py-4 border-b border-blue-500">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <x-heroicon-o-pencil-square class="w-6 h-6 mr-2" />
                    Formulir Pendaftaran
                </h2>
                <p class="text-blue-100 text-sm mt-1">Isi data dengan benar sesuai Ijazah/KK.</p>
            </div>

            <form action="{{ route('registration.store') }}" method="POST" class="p-8 space-y-8" x-data="{
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

                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Pilihan Jurusan</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Jurusan
                            <span class="text-red-500">*</span></label>
                        <select name="major_id" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach($majors as $major)
                            <option value="{{ $major->id }}">{{ $major->name }} (Sisa: {{ $major->quota -
                                $major->registrants_count }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

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
                                <option value="{{ $g->value }}">{{ $g->label() }}</option>
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
                                <option value="{{ $r->value }}">{{ $r->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

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
                        <div class="text-center">
                            <div class="text-xs text-gray-500 mb-1">Rata-Rata</div>
                            <div class="font-bold text-xl text-blue-600" x-text="average">0.00</div>
                        </div>
                    </div>
                </div>

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
                                        <option value="{{ $income->value }}">{{ $income->label() }}</option>
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
                                        <option value="{{ $income->value }}">{{ $income->label() }}</option>
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


                    <div class="pt-6">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white font-bold text-lg py-4 rounded-lg hover:bg-blue-700 shadow-lg transition transform hover:-translate-y-1">
                            Kirim Pendaftaran
                        </button>
                    </div>

            </form>
        </div>
    </div>
    @endif

    <footer class="bg-gray-900 text-white py-8 mt-12 text-center">
        <p>&copy; {{ date('Y') }} {{ \App\Models\Setting::getValue('school_name') }}. All Rights Reserved.</p>
    </footer>

</body>

</html>
