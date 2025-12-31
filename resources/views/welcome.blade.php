<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\Setting::getValue('school_name') }} - SPMB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased">

  

    <nav x-data="{ open: false }" class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

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

                <div class="hidden md:flex items-center space-x-4 relative z-10">
                    
                    <a href="/login"
                        class="text-sm font-medium bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 flex items-center transition cursor-pointer">
                        <x-heroicon-o-lock-closed class="w-4 h-4 mr-1" />
                        Login
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

            <!--<div class="pt-2 pb-3 space-y-1 px-4">
                <a href="{{ route('formulir') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">
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
                </a>-->
                <a href="{{ route('login') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">
                    <div class="flex items-center">
                        <x-heroicon-o-lock-closed class="w-5 h-5 mr-2" />
                        Admin Login
                    </div>
                </a>
            </div>
        </div>
    </nav>

    {{-- Hero Carousel Section --}}
    <div x-data="{
        activeSlide: 0,
        slides: [
            {
                image: 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1600&h=900&fit=crop',
                title: 'Selamat Datang di SPMB Online',
                subtitle: '{{ \App\Models\Setting::getValue('school_name') }}',
                gradient: 'from-blue-600 via-blue-700 to-indigo-800'
            },
            {
                image: 'https://images.unsplash.com/photo-1562774053-701939374585?w=1600&h=900&fit=crop',
                title: 'Raih Masa Depanmu Bersama Kami',
                subtitle: 'Pendidikan Berkualitas untuk Generasi Unggul',
                gradient: 'from-purple-600 via-purple-700 to-pink-700'
            },
            {
                image: 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=1600&h=900&fit=crop',
                title: 'Fasilitas Modern & Lengkap',
                subtitle: 'Lingkungan Belajar yang Nyaman dan Kondusif',
                gradient: 'from-emerald-600 via-teal-600 to-cyan-700'
            }
        ],
        autoplay: null,
        startAutoplay() {
            this.autoplay = setInterval(() => {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            }, 5000);
        },
        stopAutoplay() {
            clearInterval(this.autoplay);
        },
        goToSlide(index) {
            this.activeSlide = index;
            this.stopAutoplay();
            this.startAutoplay();
        },
        nextSlide() {
            this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            this.stopAutoplay();
            this.startAutoplay();
        },
        prevSlide() {
            this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
            this.stopAutoplay();
            this.startAutoplay();
        }
    }" x-init="startAutoplay()" class="relative w-full h-[500px] md:h-[600px] overflow-hidden">
        
        {{-- Slides Container --}}
        <div class="relative w-full h-full">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 transform scale-105"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="absolute inset-0 w-full h-full">
                    
                    {{-- Background Image --}}
                    <div class="absolute inset-0">
                        <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r opacity-80" :class="slide.gradient"></div>
                        <div class="absolute inset-0 bg-black/30"></div>
                    </div>
                    
                    {{-- Content --}}
                    <div class="relative h-full flex items-center justify-center">
                        <div class="max-w-4xl mx-auto px-6 text-center text-white">
                            <h1 x-text="slide.title" class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 drop-shadow-lg animate-fade-in-up"></h1>
                            <p x-text="slide.subtitle" class="text-xl md:text-2xl text-white/90 mb-8 drop-shadow-md"></p>
                            
                            @if($isOpen)
                            <div class="inline-flex items-center bg-green-500 text-white px-6 py-2 rounded-full font-bold shadow-lg animate-bounce mb-6">
                                <x-heroicon-o-check-circle class="w-6 h-6 mr-2" />
                                Pendaftaran Dibuka
                            </div>
                            <!--<div class="mt-4">
                                <a href="{{ route('formulir') }}"
                                    class="inline-flex items-center bg-white text-blue-900 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                                    <x-heroicon-o-pencil-square class="w-5 h-5 mr-2" />
                                    Daftar Sekarang
                                </a>
                            </div>-->
                            @else
                            <div class="inline-flex items-center bg-red-500/90 text-white px-6 py-3 rounded-full font-bold shadow-lg">
                                <x-heroicon-o-x-circle class="w-6 h-6 mr-2" />
                                Pendaftaran Ditutup
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Navigation Arrows --}}
        <button @click="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/40 transition-all duration-300 group">
            <x-heroicon-o-chevron-left class="w-6 h-6 group-hover:scale-110 transition-transform" />
        </button>
        <button @click="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/40 transition-all duration-300 group">
            <x-heroicon-o-chevron-right class="w-6 h-6 group-hover:scale-110 transition-transform" />
        </button>

        {{-- Dots Indicator --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center space-x-3">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="goToSlide(index)"
                    :class="activeSlide === index ? 'w-8 bg-white' : 'w-3 bg-white/50 hover:bg-white/70'"
                    class="h-3 rounded-full transition-all duration-300">
                </button>
            </template>
        </div>

        {{-- Slide Counter --}}
        <div class="absolute bottom-6 right-6 bg-black/30 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium">
            <span x-text="activeSlide + 1"></span> / <span x-text="slides.length"></span>
        </div>
    </div>

    {{-- Quick Info Cards --}}
    <div class="relative -mt-12 md:-mt-16 z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
            {{-- Card 1: Pendaftaran --}}
            <a href="{{ route('formulir') }}" class="group bg-white rounded-xl shadow-lg p-4 sm:p-5 lg:p-6 flex flex-col sm:flex-row items-center sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                <div class="flex-shrink-0 w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <x-heroicon-o-pencil-square class="w-6 h-6 sm:w-7 sm:h-7 text-white" />
                </div>
                <div class="text-center sm:text-left">
                    <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors text-sm sm:text-base">Pendaftaran</h3>
                    <p class="text-xs sm:text-sm text-gray-500 hidden sm:block">Isi formulir pendaftaran</p>
                </div>
            </a>
            
            {{-- Card 2: Cek Status --}}
            <a href="{{ route('registration.check-status.form') }}" class="group bg-white rounded-xl shadow-lg p-4 sm:p-5 lg:p-6 flex flex-col sm:flex-row items-center sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                <div class="flex-shrink-0 w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <x-heroicon-o-clipboard-document-check class="w-6 h-6 sm:w-7 sm:h-7 text-white" />
                </div>
                <div class="text-center sm:text-left">
                    <h3 class="font-bold text-gray-900 group-hover:text-emerald-600 transition-colors text-sm sm:text-base">Cek Status</h3>
                    <p class="text-xs sm:text-sm text-gray-500 hidden sm:block">Lihat status pendaftaran</p>
                </div>
            </a>
            
            {{-- Card 3: Tes Minat & Bakat --}}
            <a href="{{ route('ujian-tes') }}" class="group bg-white rounded-xl shadow-lg p-4 sm:p-5 lg:p-6 flex flex-col sm:flex-row items-center sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                <div class="flex-shrink-0 w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <x-heroicon-o-document-text class="w-6 h-6 sm:w-7 sm:h-7 text-white" />
                </div>
                <div class="text-center sm:text-left">
                    <h3 class="font-bold text-gray-900 group-hover:text-orange-600 transition-colors text-sm sm:text-base">Tes Minat</h3>
                    <p class="text-xs sm:text-sm text-gray-500 hidden sm:block">Tes Jurusan & Kecerdasan</p>
                </div>
            </a>
            
            {{-- Card 4: Pengumuman --}}
            <a href="{{ route('pengumuman-seleksi') }}" class="group bg-white rounded-xl shadow-lg p-4 sm:p-5 lg:p-6 flex flex-col sm:flex-row items-center sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                <div class="flex-shrink-0 w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <x-heroicon-o-megaphone class="w-6 h-6 sm:w-7 sm:h-7 text-white" />
                </div>
                <div class="text-center sm:text-left">
                    <h3 class="font-bold text-gray-900 group-hover:text-purple-600 transition-colors text-sm sm:text-base">Pengumuman</h3>
                    <p class="text-xs sm:text-sm text-gray-500 hidden sm:block">Hasil seleksi penerimaan</p>
                </div>
            </a>
        </div>
    </div>
  {{-- Teks Berjalan Pengumuman --}}
    <div class="bg-white text-black py-2 overflow-hidden">
        <div class="animate-marquee whitespace-nowrap flex items-center">
            <span class="mx-8 flex items-center">
                <x-heroicon-o-ex`clamation-triangle class="w-5 h-5 mr-2" />
                <strong>Pengumuman:</strong>&nbsp;Pelaksanaan SPMB Online tidak dipungut biaya (GRATIS)
            </span>
           
        </div>
    </div>

    <style>
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-33.33%); }
        }
        .animate-marquee {
            animation: marquee 15s linear infinite;
        }
    </style>
    <div class="bg-white py-12 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center mb-8 text-gray-900">Program Keahlian</h2>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                @foreach($majors as $major)
                @php
                    // Mapping kode jurusan ke icon dan warna
                    $iconMap = [
                        'RPL' => ['icon' => 'code-bracket', 'color' => 'blue'],
                        'AKL' => ['icon' => 'calculator', 'color' => 'amber'],
                        'MP' => ['icon' => 'building-office', 'color' => 'cyan'],
                        'TKR' => ['icon' => 'wrench-screwdriver', 'color' => 'red'],
                        'TSM' => ['icon' => 'cog-6-tooth', 'color' => 'slate'],
                        'FARMASI' => ['icon' => 'beaker', 'color' => 'emerald'],
                     
                    ];
                    $majorCode = strtoupper($major->code);
                    $iconData = $iconMap[$majorCode] ?? ['icon' => 'academic-cap', 'color' => 'blue'];
                    $iconName = 'heroicon-o-' . $iconData['icon'];
                    $color = $iconData['color'];
                @endphp
                <div class="p-6 rounded-lg border border-gray-100 hover:shadow-md transition text-center group">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 bg-{{ $color }}-100 group-hover:bg-{{ $color }}-600 transition">
                        <x-dynamic-component :component="$iconName" class="w-8 h-8 text-{{ $color }}-600 group-hover:text-white transition" />
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
    {{-- Call to Action - Daftar Sekarang --}}
    <!--<div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Siap Bergabung dengan Kami?</h2>
            <p class="text-blue-100 text-lg mb-8">Isi formulir pendaftaran online dan mulai perjalanan pendidikanmu bersama kami.</p>
            @if($isOpen)
            <a href="{{ route('formulir') }}"
                class="inline-flex items-center bg-white text-blue-700 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-xl transform hover:-translate-y-1">
                <x-heroicon-o-pencil-square class="w-6 h-6 mr-2" />
                Isi Formulir Pendaftaran
            </a>
            @else
            <div class="inline-flex items-center bg-red-500/20 text-white px-6 py-3 rounded-lg font-medium">
                <x-heroicon-o-x-circle class="w-5 h-5 mr-2" />
                Pendaftaran Saat Ini Ditutup
            </div>
            @endif
        </div>
    </div>-->

    <footer class="bg-gray-900 text-white py-8 mt-12 text-center">
        <p>&copy; {{ date('Y') }} {{ \App\Models\Setting::getValue('school_name') }}. All Rights Reserved.</p>
    </footer>

</body>

</html>
