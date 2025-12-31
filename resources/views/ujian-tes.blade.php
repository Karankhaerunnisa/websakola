<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tes Minat & Bakat - {{ \App\Models\Setting::getValue('school_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased min-h-screen flex flex-col">

    <nav x-data="{ open: false }" class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <div class="flex items-center gap-3">
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
                </div>

                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium text-gray-600 hover:text-blue-600 flex items-center transition">
                        <x-heroicon-o-home class="w-4 h-4 mr-1" />
                        Beranda
                    </a>
                    <a href="{{ route('pengumuman-seleksi') }}"
                        class="text-sm font-medium text-gray-600 hover:text-blue-600 flex items-center transition">
                        <x-heroicon-o-academic-cap class="w-4 h-4 mr-1" />
                        Pengumuman Seleksi
                    </a>
                </div>

                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
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

    <main class="flex-grow flex flex-col items-center p-4 py-8">

        {{-- Header Section --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mb-4 shadow-lg">
                <x-heroicon-o-document-text class="w-8 h-8 text-white" />
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Tes Minat & Bakat</h1>
            <p class="text-gray-500">Ikuti tes minat bakat dan upload hasil tes Anda</p>
        </div>

        <div class="w-full max-w-2xl space-y-6">
            {{-- Link Ujian Section --}}
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                    <h2 class="text-lg font-bold text-white flex items-center">
                        <x-heroicon-o-link class="w-5 h-5 mr-2" />
                        Link Tes Minat Bakat
                    </h2>
                </div>

                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-4">Klik link di bawah ini untuk mengikuti ujian seleksi:</p>
                    
                    <div class="space-y-3">
                        <a href="{{ \App\Models\Setting::getValue('exam_link_1', 'https://www.arealme.com/what-should-i-major-in/id/') }}" target="_blank"
                            class="flex items-center justify-between p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition group">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-3">
                                    <x-heroicon-o-document-text class="w-5 h-5 text-white" />
                                </div>
                                <div>
                                    <div class="font-bold text-blue-900">Tes Jurusan</div>
                                    <div class="text-xs text-blue-600">Tes ini membantu calon peserta mengetahui jurusan yang paling sesuai dengan minat dan bakatnya.</div>
                                </div>
                            </div>
                            <x-heroicon-o-arrow-top-right-on-square class="w-5 h-5 text-blue-600 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" />
                        </a>

                        <a href="{{ \App\Models\Setting::getValue('exam_link_2', 'https://www.arealme.com/talent-compass-quiz/en/') }}" target="_blank"
                            class="flex items-center justify-between p-4 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition group">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center mr-3">
                                    <x-heroicon-o-calculator class="w-5 h-5 text-white" />
                                </div>
                                <div>
                                    <div class="font-bold text-purple-900">Tes Multiple Intelligences</div>
                                    <div class="text-xs text-purple-600">Tes mengukur kecerdasan emosioal, intelektual, logika, dan lainnya</div>
                                </div>
                            </div>
                            <x-heroicon-o-arrow-top-right-on-square class="w-5 h-5 text-purple-600 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" />
                        </a>
                    </div>
                </div>
            </div>

            
            {{-- Upload Hasil Ujian Section --}}
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-4">
                    <h2 class="text-lg font-bold text-white flex items-center">
                        <x-heroicon-o-cloud-arrow-up class="w-5 h-5 mr-2" />
                        Upload Hasil Ujian
                    </h2>
                </div>

                <div class="p-6">
                    @if(session('success'))
                    <div class="bg-green-50 text-green-700 text-sm p-4 rounded-lg mb-4 flex items-center">
                        <x-heroicon-o-check-circle class="w-5 h-5 mr-2 flex-shrink-0" />
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="bg-red-50 text-red-600 text-sm p-4 rounded-lg mb-4 flex items-center">
                        <x-heroicon-o-exclamation-circle class="w-5 h-5 mr-2 flex-shrink-0" />
                        {{ session('error') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="bg-red-50 text-red-600 text-sm p-4 rounded-lg mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Check Status Section --}}
                    @if(request('registration_number') && !$registrant)
                        {{-- Registration number not found --}}
                        <div class="bg-red-50 border border-red-200 rounded-lg p-6 text-center mb-4">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-red-100 rounded-full mb-3">
                                <x-heroicon-o-x-circle class="w-8 h-8 text-red-600" />
                            </div>
                            <h3 class="text-lg font-bold text-red-800 mb-2">Nomor Pendaftaran Tidak Ditemukan</h3>
                            <p class="text-red-600 text-sm">Nomor pendaftaran <strong>{{ request('registration_number') }}</strong> tidak terdaftar dalam sistem.</p>
                        </div>
                    @elseif(isset($examResult) && $examResult && $examResult->exam1_image && $examResult->exam2_image)
                        {{-- Already Uploaded - Show Success Status --}}
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                                <x-heroicon-o-check-circle class="w-10 h-10 text-green-600" />
                            </div>
                            <h3 class="text-lg font-bold text-green-800 mb-2">Tes Minat & Bakat Selesai!</h3>
                            <p class="text-green-600 text-sm mb-4">Anda sudah berhasil mengupload hasil tes minat & bakat.</p>
                            
                            <div class="bg-white rounded-lg p-4 border border-green-200">
                                <p class="text-sm text-gray-600 mb-2"><span class="font-semibold">Nomor Pendaftaran:</span> {{ $registrant->registration_number }}</p>
                                <p class="text-sm text-gray-600 mb-3"><span class="font-semibold">Nama:</span> {{ $registrant->name }}</p>
                                
                                <div class="grid grid-cols-2 gap-3 mt-4">
                                    <div class="text-center">
                                        <p class="text-xs font-semibold text-gray-500 mb-2">Hasil Tes 1</p>
                                        <a href="{{ asset('storage/exam_results/' . $examResult->exam1_image) }}" target="_blank" class="block">
                                            <img src="{{ asset('storage/exam_results/' . $examResult->exam1_image) }}" alt="Hasil Tes 1" class="w-full h-24 object-cover rounded-lg border border-gray-200 hover:border-green-400 transition">
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xs font-semibold text-gray-500 mb-2">Hasil Tes 2</p>
                                        <a href="{{ asset('storage/exam_results/' . $examResult->exam2_image) }}" target="_blank" class="block">
                                            <img src="{{ asset('storage/exam_results/' . $examResult->exam2_image) }}" alt="Hasil Tes 2" class="w-full h-24 object-cover rounded-lg border border-gray-200 hover:border-green-400 transition">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                          
                        </div>
                    @elseif($registrant && (!$examResult || !$examResult->exam1_image || !$examResult->exam2_image))
                        {{-- Registrant found but not yet uploaded --}}
                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <x-heroicon-o-exclamation-triangle class="w-6 h-6 text-amber-600 mr-3" />
                                <div>
                                    <p class="font-bold text-amber-800">{{ $registrant->name }}</p>
                                    <p class="text-sm text-amber-700">Belum mengupload hasil tes minat & bakat.</p>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Form Upload --}}
                        <form action="{{ route('ujian-tes.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Pendaftaran <span class="text-red-500">*</span></label>
                                <input type="text" name="registration_number" value="{{ old('registration_number') }}"
                                    required placeholder="Contoh: PPDB2025XXXXX"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 uppercase">
                            

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <x-heroicon-o-photo class="w-4 h-4 inline mr-1" />
                                        Screenshot Hasil Tes Jurusan <span class="text-red-500">*</span>
                                    </label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-green-400 transition bg-gray-50">
                                        <input type="file" name="exam1_image" accept=".jpg,.jpeg,.png" required
                                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG. Maks: 1MB</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <x-heroicon-o-photo class="w-4 h-4 inline mr-1" />
                                        Screenshot Hasil Tes Multiple Intelligences <span class="text-red-500">*</span>
                                    </label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-green-400 transition bg-gray-50">
                                        <input type="file" name="exam2_image" accept=".jpg,.jpeg,.png" required
                                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG. Maks: 1MB</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 text-sm text-amber-700">
                                <x-heroicon-o-exclamation-triangle class="w-4 h-4 inline mr-1" />
                                <strong>Perhatian:</strong> Upload hanya dapat dilakukan sekali dan tidak dapat diubah.
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold py-3 rounded-md hover:from-green-700 hover:to-emerald-700 transition shadow-md flex items-center justify-center">
                                <x-heroicon-o-cloud-arrow-up class="w-5 h-5 mr-2" />
                                Upload Hasil Ujian
                            </button>
                        </form>
                    @else
                        {{-- Default Form Upload (no query) --}}
                        <form action="{{ route('ujian-tes.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Pendaftaran <span class="text-red-500">*</span></label>
                                <input type="text" name="registration_number" value="{{ old('registration_number') }}"
                                    required placeholder="Contoh: PPDB2025XXXXX"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 uppercase">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <x-heroicon-o-photo class="w-4 h-4 inline mr-1" />
                                        Screenshot Hasil Ujian 1 <span class="text-red-500">*</span>
                                    </label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-green-400 transition bg-gray-50">
                                        <input type="file" name="exam1_image" accept=".jpg,.jpeg,.png" required
                                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG. Maks: 1MB</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <x-heroicon-o-photo class="w-4 h-4 inline mr-1" />
                                        Screenshot Hasil Ujian 2 <span class="text-red-500">*</span>
                                    </label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-green-400 transition bg-gray-50">
                                        <input type="file" name="exam2_image" accept=".jpg,.jpeg,.png" required
                                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG. Maks: 1MB</p>
                                    </div>
                                </div>
                            </div>


                            <button type="submit"
                                class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold py-3 rounded-md hover:from-green-700 hover:to-emerald-700 transition shadow-md flex items-center justify-center">
                                <x-heroicon-o-cloud-arrow-up class="w-5 h-5 mr-2" />
                                Upload Hasil Ujian
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Info Box --}}
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                <div class="flex items-start">
                    <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-amber-600 mr-3 flex-shrink-0 mt-0.5" />
                    <div class="text-sm text-amber-800">
                        <p class="font-bold mb-1">Petunjuk Pengisian:</p>
                        <ul class="list-disc list-inside space-y-1">
                    <ul class="list-disc pl-5 space-y-1">
  <li>Ikuti dan selesaikan <strong>Tes Minat & Bakat</strong> sesuai urutan yang tersedia.</li>
  <li>Setelah <strong>Tes 1 selesai</strong>, lakukan <strong>screenshot halaman hasil tes</strong>, lalu <strong>upload</strong> hasil tersebut.</li>
  <li>Setelah itu, lanjutkan <strong>Tes 2</strong>. Setelah selesai, lakukan <strong>screenshot</strong> dan <strong>upload</strong> hasil tes.</li>
  <li><strong class="text-red-700">Upload hanya dapat dilakukan 1 kali untuk setiap tes dan tidak dapat diulang.</strong></li>
  <li>Pastikan tes dikerjakan dengan <strong>jujur</strong> dan sesuai dengan <strong>kepribadian serta minat pribadi siswa</strong>.</li>
  <li>Tidak tersedia pengulangan tes. Pastikan sebelum mengirim hasil sudah benar.</li>
  <li>Hasil tes akan ditampilkan pada <strong>halaman Pengumuman Seleksi</strong>.</li>
</ul>        
                    
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} {{ \App\Models\Setting::getValue('school_name') }}.
    </footer>

</body>

</html>
