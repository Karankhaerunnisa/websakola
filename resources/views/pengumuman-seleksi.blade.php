<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengumuman Seleksi - {{ \App\Models\Setting::getValue('school_name') }}</title>
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
                <a href="{{ route('registration.check-status.form') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">
                    <div class="flex items-center">
                        <x-heroicon-o-magnifying-glass class="w-5 h-5 mr-2" />
                        Pengumuman Seleksi
                    </div>
                </a>
                           </div>
        </div>
    </nav>

    <main class="flex-grow flex flex-col items-center justify-center p-4 py-8">

        {{-- Header Section --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full mb-4 shadow-lg">
                <x-heroicon-o-academic-cap class="w-8 h-8 text-white" />
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Pengumuman Seleksi</h1>
            <div class="bg-red-100 text-red-700 p-3 rounded">
  <strong>Akses!</strong> SPMB Gelombang I tgl 18 Maret 2026 
  <!--<br>
 <strong>Akses!</strong> SPMB Gelombang 2 tgl 18 April 2026 <br>
  <strong>Akses!</strong> SPMB Gelombang 3 tgl 18 Juni 2026 </strong>.-->
</div>
        </div>

        {{-- Search Form --}}
        <div class="w-full max-w-md bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                <h2 class="text-lg font-bold text-white flex items-center">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 mr-2" />
                    Cek Hasil Seleksi
                </h2>
            </div>

            <div class="p-6">
                <form action="{{ route('pengumuman-seleksi.check') }}" method="POST">
                    @csrf

                    @if(session('error'))
                    <div class="bg-red-50 text-red-600 text-sm p-3 rounded-md mb-4 flex items-center">
                        <x-heroicon-o-exclamation-circle class="w-5 h-5 mr-2 flex-shrink-0" />
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NISN / Nomor Pendaftaran</label>
                            <input type="text" name="search_key" value="{{ old('search_key') }}"
                                required placeholder="Masukkan NISN atau Nomor Pendaftaran"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Contoh: 1234567890 atau PPDB2025XXXXX</p>
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-3 rounded-md hover:from-blue-700 hover:to-indigo-700 transition shadow-md flex items-center justify-center">
                            <x-heroicon-o-magnifying-glass class="w-5 h-5 mr-2" />
                            Cari Hasil Seleksi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Result Section --}}
        @if(isset($result))
        <div class="w-full max-w-md animate-fade-in-up">
            @if($result['status'] === 'Lulus')
            {{-- Lulus Card --}}
            <div class="bg-white rounded-xl shadow-lg border-2 border-green-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-8 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4 shadow-lg">
                        <x-heroicon-o-check-circle class="w-12 h-12 text-green-500" />
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-1">SELAMAT!</h3>
                    <p class="text-green-100">Anda dinyatakan</p>
                    <span class="inline-block mt-2 px-6 py-2 bg-white text-green-600 font-bold text-xl rounded-full shadow">
                        LULUS
                    </span>
                </div>

                <div class="p-6 space-y-4">
                    <div class="text-center border-b border-gray-100 pb-4">
                        <h4 class="text-xl font-bold text-gray-900">{{ $result['registrant']->name }}</h4>
                        <p class="text-gray-500 text-sm">{{ $result['registrant']->registration_number }}</p>
                    </div>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-gray-500">NISN</span>
                            <span class="font-mono font-bold text-gray-900">{{ $result['registrant']->nisn }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-gray-500">Jurusan</span>
                            <span class="font-bold text-gray-900">{{ $result['registrant']->major->name }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-500">Tanggal Pengumuman</span>
                            <span class="font-medium text-gray-900">{{ $result['pengumuman']->created_at->format('d M Y') }}</span>
                        </div>
                    </div>

                    {{-- Hasil Ujian/Tes --}}
                    @if(isset($result['examResult']) && ($result['examResult']->exam1_image || $result['examResult']->exam2_image))
                    <div class="mt-4">
                        <h5 class="text-sm font-bold text-gray-700 mb-3 flex items-center">
                            <x-heroicon-o-document-text class="w-4 h-4 mr-1" />
                            Hasil Ujian/Tes
                        </h5>
                        <div class="grid grid-cols-2 gap-3">
                            @if($result['examResult']->exam1_image)
                            <a href="{{ asset('storage/exam_results/' . $result['examResult']->exam1_image) }}" target="_blank" class="block">
                                <img src="{{ asset('storage/exam_results/' . $result['examResult']->exam1_image) }}" 
                                    alt="Hasil Ujian 1" 
                                    class="w-full h-32 object-cover rounded-lg border border-gray-200 hover:opacity-90 transition">
                                <p class="text-xs text-center text-gray-500 mt-1">Ujian 1</p>
                            </a>
                            @endif
                            @if($result['examResult']->exam2_image)
                            <a href="{{ asset('storage/exam_results/' . $result['examResult']->exam2_image) }}" target="_blank" class="block">
                                <img src="{{ asset('storage/exam_results/' . $result['examResult']->exam2_image) }}" 
                                    alt="Hasil Ujian 2" 
                                    class="w-full h-32 object-cover rounded-lg border border-gray-200 hover:opacity-90 transition">
                                <p class="text-xs text-center text-gray-500 mt-1">Ujian 2</p>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm text-green-700">
                            <x-heroicon-o-information-circle class="w-4 h-4 inline mr-1" />
                            Segera lakukan daftar ulang sesuai jadwal yang telah ditentukan.
                        </p>
                    </div>
                </div>
            </div>

            @else
            {{-- Tidak Lulus Card --}}
            <div class="bg-white rounded-xl shadow-lg border-2 border-red-200 overflow-hidden">
                <div class="bg-gradient-to-r from-red-500 to-rose-500 px-6 py-8 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4 shadow-lg">
                        <x-heroicon-o-x-circle class="w-12 h-12 text-red-500" />
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-1">MOHON MAAF</h3>
                    <p class="text-red-100">Anda dinyatakan</p>
                    <span class="inline-block mt-2 px-6 py-2 bg-white text-red-600 font-bold text-xl rounded-full shadow">
                        TIDAK LULUS
                    </span>
                </div>

                <div class="p-6 space-y-4">
                    <div class="text-center border-b border-gray-100 pb-4">
                        <h4 class="text-xl font-bold text-gray-900">{{ $result['registrant']->name }}</h4>
                        <p class="text-gray-500 text-sm">{{ $result['registrant']->registration_number }}</p>
                    </div>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-gray-500">NISN</span>
                            <span class="font-mono font-bold text-gray-900">{{ $result['registrant']->nisn }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-gray-500">Jurusan</span>
                            <span class="font-bold text-gray-900">{{ $result['registrant']->major->name }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-500">Tanggal Pengumuman</span>
                            <span class="font-medium text-gray-900">{{ $result['pengumuman']->created_at->format('d M Y') }}</span>
                        </div>
                    </div>

                    {{-- Hasil Ujian/Tes --}}
                    @if(isset($result['examResult']) && ($result['examResult']->exam1_image || $result['examResult']->exam2_image))
                    <div class="mt-4">
                        <h5 class="text-sm font-bold text-gray-700 mb-3 flex items-center">
                            <x-heroicon-o-document-text class="w-4 h-4 mr-1" />
                            Hasil Ujian/Tes
                        </h5>
                        <div class="grid grid-cols-2 gap-3">
                            @if($result['examResult']->exam1_image)
                            <a href="{{ asset('storage/exam_results/' . $result['examResult']->exam1_image) }}" target="_blank" class="block">
                                <img src="{{ asset('storage/exam_results/' . $result['examResult']->exam1_image) }}" 
                                    alt="Hasil Ujian 1" 
                                    class="w-full h-32 object-cover rounded-lg border border-gray-200 hover:opacity-90 transition">
                                <p class="text-xs text-center text-gray-500 mt-1">Ujian 1</p>
                            </a>
                            @endif
                            @if($result['examResult']->exam2_image)
                            <a href="{{ asset('storage/exam_results/' . $result['examResult']->exam2_image) }}" target="_blank" class="block">
                                <img src="{{ asset('storage/exam_results/' . $result['examResult']->exam2_image) }}" 
                                    alt="Hasil Ujian 2" 
                                    class="w-full h-32 object-cover rounded-lg border border-gray-200 hover:opacity-90 transition">
                                <p class="text-xs text-center text-gray-500 mt-1">Ujian 2</p>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-700">
                            <x-heroicon-o-information-circle class="w-4 h-4 inline mr-1" />
                            Jangan berkecil hati. Tetap semangat dan terus berusaha!
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endif

        {{-- Not Found Result --}}
        @if(isset($notFound) && $notFound)
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden animate-fade-in-up">
            <div class="p-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                    <x-heroicon-o-question-mark-circle class="w-8 h-8 text-gray-400" />
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Data Tidak Ditemukan</h3>
                <p class="text-gray-500 text-sm">
                    Pastikan NISN atau Nomor Pendaftaran yang Anda masukkan sudah benar, atau pengumuman belum tersedia.
                </p>
            </div>
        </div>
        @endif

    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} {{ \App\Models\Setting::getValue('school_name') }}.
    </footer>

</body>

</html>
