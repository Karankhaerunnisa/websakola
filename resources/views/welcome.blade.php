<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\Setting::getValue('school_name') }} - SPMB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    {{-- Top Bar dengan Kontak dan Link --}}
    <div class="bg-gray-100 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-8 text-xs">
                {{-- Left Side: Navigation Links --}}
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('tentang-kami') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Tentang Kami</a>
                    <a href="{{ route('bursa-kerja') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">BKK</a>
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">LOGIN</a>
                </div>
                
                {{-- Right Side: Contact Info --}}
                <div class="flex items-center space-x-4 ml-auto">
                    
                    <a href="tel:{{ \App\Models\Setting::getValue('school_phone', '0262-448446') }}" class="flex items-center text-gray-600 hover:text-blue-600 transition">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="hidden sm:inline">{{ \App\Models\Setting::getValue('school_phone', '0262-448446') }}</span>
                    </a>
                    <a href="mailto:{{ \App\Models\Setting::getValue('school_email', 'info@smkalghifari.sch.id') }}" class="flex items-center text-gray-600 hover:text-blue-600 transition">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="hidden sm:inline">{{ \App\Models\Setting::getValue('school_email', 'ppdb@smkalghifari.sch.id') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

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
                        class="text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition">
                        <x-heroicon-o-home class="w-4 h-4 mr-1" />
                        Beranda
                    </a>
                    <a href="{{ route('alumni') }}"
                        class="text-sm font-medium {{ request()->routeIs('alumni') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition">
                        <x-heroicon-o-users class="w-4 h-4 mr-1" />
                        Alumni
                    </a>
                    <a href="{{ route('prestasi') }}"
                        class="text-sm font-medium {{ request()->routeIs('prestasi') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition">
                        <x-heroicon-o-trophy class="w-4 h-4 mr-1" />
                        Prestasi
                    </a>
                    <a href="{{ route('ekskul') }}"
                        class="text-sm font-medium {{ request()->routeIs('ekskul') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition">
                        <x-heroicon-o-academic-cap class="w-4 h-4 mr-1" />
                        Ekstrakurikuler
                    </a>
                    <a href="{{ route('kegiatan') }}"
                        class="text-sm font-medium {{ request()->routeIs('kegiatan') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition">
                        <x-heroicon-o-calendar-days class="w-4 h-4 mr-1" />
                        Kegiatan
                    </a>
                    <a href="{{ route('mitra') }}"
                        class="text-sm font-medium {{ request()->routeIs('mitra') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition">
                        <x-heroicon-o-building-office class="w-4 h-4 mr-1" />
                        Mitra Kerjasama
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
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-home class="w-5 h-5 mr-2" />
                        Beranda
                    </div>
                </a>
                <a href="{{ route('alumni') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('alumni') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-users class="w-5 h-5 mr-2" />
                        Alumni
                    </div>
                </a>
                <a href="{{ route('prestasi') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('prestasi') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-trophy class="w-5 h-5 mr-2" />
                        Prestasi
                    </div>
                </a>
                <a href="{{ route('ekskul') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('ekskul') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" />
                        Ekstrakurikuler
                    </div>
                </a>
                <a href="{{ route('kegiatan') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('kegiatan') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-calendar-days class="w-5 h-5 mr-2" />
                        Kegiatan
                    </div>
                </a>
                <a href="{{ route('mitra') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('mitra') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-building-office class="w-5 h-5 mr-2" />
                        Mitra Kerjasama
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
                image: '{{ asset('images/gambar1.jpeg') }}',
                title: 'Selamat Datang di SPMB Online',
                subtitle: '{{ \App\Models\Setting::getValue('school_name') }}',
                gradient: 'from-blue-600 via-blue-700 to-indigo-800'
            },
            {
                image: '{{ asset('images/gambar2.jpeg') }}',
                
            },
            {
                image: '{{ asset('images/school-logo.jpg') }}',
                
            }
        ],
        goToSlide(index) {
            this.activeSlide = index;
        },
        nextSlide() {
            this.activeSlide = (this.activeSlide + 1) % this.slides.length;
        },
        prevSlide() {
            this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
        }
    }" class="relative w-full h-[500px] md:h-[600px] overflow-hidden">
        
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
                        {{-- Gradient hanya untuk slide pertama --}}
                        <template x-if="index === 0">
                            <div class="absolute inset-0 bg-gradient-to-r opacity-80" :class="slide.gradient"></div>
                        </template>
                        <template x-if="index === 0">
                            <div class="absolute inset-0 bg-black/30"></div>
                        </template>
                    </div>
                    
                    {{-- Content - hanya untuk slide pertama --}}
                    <template x-if="index === 0">
                        <div class="relative h-full flex items-center justify-center">
                            <div class="max-w-4xl mx-auto px-6 text-center text-white">
                                <h1 x-text="slide.title" class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 drop-shadow-lg animate-fade-in-up"></h1>
                                <p x-text="slide.subtitle" class="text-xl md:text-2xl text-white/90 mb-8 drop-shadow-md"></p>
                                
                                @if($isOpen)
                                <div class="inline-flex items-center bg-green-500 text-white px-6 py-2 rounded-full font-bold shadow-lg animate-bounce mb-6">
                                    <x-heroicon-o-check-circle class="w-6 h-6 mr-2" />
                                    Pendaftaran Dibuka
                                </div>
                                @else
                                <div class="inline-flex items-center bg-red-500/90 text-white px-6 py-3 rounded-full font-bold shadow-lg mb-6">
                                    <x-heroicon-o-x-circle class="w-6 h-6 mr-2" />
                                    Pendaftaran Ditutup
                                </div>
                                @endif
                                
                                {{-- Button Juknis Teknis --}}
                                <div class="mt-2">
                                    <a href="https://drive.google.com/file/d/GANTI_DENGAN_ID_FILE/view" target="_blank" 
                                       class="inline-flex items-center bg-white/20 backdrop-blur-sm text-white px-6 py-3 rounded-full font-medium shadow-lg hover:bg-white/30 transition-all duration-300 hover:scale-105 border border-white/30">
                                        <x-heroicon-o-document-arrow-down class="w-5 h-5 mr-2" />
                                        Download Juknis Teknis
                                        <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4 ml-2 opacity-70" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </template>
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
   {{-- Marquee Pengumuman --}}
<div class="bg-white border-y py-2 overflow-hidden">
    <div class="marquee-wrapper">
        <span class="marquee-text text-gray-900 text-sm md:text-base whitespace-nowrap"><svg class="w-5 h-5 mr-2 text-amber-500 inline-block align-middle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg><strong>Pengumuman Pelaksanaan SPMB Online tidak dipungut biaya (GRATIS)</strong></span>
    </div>
</div>
<style>
    .marquee-wrapper { display: flex; }
    .marquee-text { 
        display: inline-block; 
        padding-left: 100%; 
        animation: marquee-scroll 30s linear infinite; 
    }
    @keyframes marquee-scroll { 
        0% { transform: translateX(0); } 
        100% { transform: translateX(-100%); } 
    }
    @media (min-width: 768px) { .marquee-text { animation-duration: 20s; } }
</style>
    <div class="bg-white py-12 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center mb-8 text-gray-900">Konsentrasi Keahlian</h2>
            <div class="grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
                @foreach($majors as $major)
                @php
                    // Mapping kode jurusan ke icon, warna (static classes), dan URL YouTube
                    $iconMap = [
                        'RPL' => [
                            'icon' => 'code-bracket', 
                            'bgClass' => 'bg-blue-100', 
                            'bgHoverClass' => 'group-hover:bg-blue-600', 
                            'textClass' => 'text-blue-600',
                            'url' => 'https://youtube.com/@smkalghifari-rpl'
                        ],
                        'AK' => [
                            'icon' => 'calculator', 
                            'bgClass' => 'bg-amber-100', 
                            'bgHoverClass' => 'group-hover:bg-amber-600', 
                            'textClass' => 'text-amber-600',
                            'url' => 'https://youtube.com/@smkalghifari-akl'
                        ],
                        'MP' => [
                            'icon' => 'building-office', 
                            'bgClass' => 'bg-cyan-100', 
                            'bgHoverClass' => 'group-hover:bg-cyan-600', 
                            'textClass' => 'text-cyan-600',
                            'url' => 'https://youtube.com/@smkalghifari-mp'
                        ],
                        'TKRO' => [
                            'icon' => 'wrench-screwdriver', 
                            'bgClass' => 'bg-red-100', 
                            'bgHoverClass' => 'group-hover:bg-red-600', 
                            'textClass' => 'text-red-600',
                            'url' => 'https://youtube.com/@smkalghifari-tkr'
                        ],
                        'TSM' => [
                            'icon' => 'cog-6-tooth', 
                            'bgClass' => 'bg-slate-100', 
                            'bgHoverClass' => 'group-hover:bg-slate-600', 
                            'textClass' => 'text-slate-600',
                            'url' => 'https://youtube.com/@smkalghifari-tsm'
                        ],
                        'FKK' => [
                            'icon' => 'beaker', 
                            'bgClass' => 'bg-emerald-100', 
                            'bgHoverClass' => 'group-hover:bg-emerald-600', 
                            'textClass' => 'text-emerald-600',
                            'url' => 'https://youtu.be/UiEAFnF3s9k?si=lKnVJJ9dsiJ9lcvQ'
                        ],
                    ];
                    $majorCode = strtoupper($major->code);
                    $iconData = $iconMap[$majorCode] ?? [
                        'icon' => 'academic-cap', 
                        'bgClass' => 'bg-blue-100', 
                        'bgHoverClass' => 'group-hover:bg-blue-600', 
                        'textClass' => 'text-blue-600',
                        'url' => '#'
                    ];
                    $iconName = 'heroicon-o-' . $iconData['icon'];
                @endphp
                <div class="p-6 rounded-lg border border-gray-100 hover:shadow-md transition text-center group">
                    {{-- Icon dengan Link ke Halaman Detail --}}
                    <a href="{{ route('jurusan.show', $major) }}" 
                        class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 {{ $iconData['bgClass'] }} {{ $iconData['bgHoverClass'] }} transition cursor-pointer hover:scale-110 transform duration-200">
                        <x-dynamic-component :component="$iconName" class="w-8 h-8 {{ $iconData['textClass'] }} group-hover:text-white transition" />
                    </a>
                    <a href="{{ route('jurusan.show', $major) }}" class="hover:text-blue-600 transition">
                        <h3 class="font-bold text-gray-800 mb-2">{{ $major->name }}</h3>
                    </a>
                    <div class="text-xs text-gray-500 mb-3">{{ $major->description }}</div>
                    <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded mb-3">
                        Sisa Kuota: {{ $major->quota - $major->registrants_count }}
                    </span>
                    <a href="{{ route('jurusan.show', $major) }}" 
                        class="block mt-2 text-xs text-blue-600 hover:text-blue-800 font-medium">
                        Lihat Detail →
                    </a>
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

    {{-- Section Pengumuman / Jadwal Pendaftaran - Grid 4 Kolom --}}
    @if(isset($announcements) && $announcements->count() > 0)
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">
                    Berita Informasi
                </h2>
                <p class="text-xs text-gray-500 mt-2">Pastikan Anda mendaftar sesuai dengan jadwal gelombang yang tersedia</p>
            </div>
            
            {{-- Grid 4 Kolom --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($announcements as $announcement)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1"
                    x-data="{ liked: false, likeCount: {{ rand(9000, 99999999) }} }">
                    
                    {{-- Header dengan Judul --}}
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-3">
                        <h3 class="font-bold text-white text-sm truncate">{{ $announcement->title }}</h3>
                    </div>
                    
                    {{-- Body --}}
                    <div class="p-4">
                        {{-- Isi Pengumuman (mendukung tag HTML: <b>, <strong>, <u>, <i>, <em>, <br>) --}}
                        <div class="text-sm text-gray-700 leading-relaxed mb-4">{!! nl2br($announcement->content) !!}</div>
                        
                        {{-- Like Button --}}
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <button @click="liked = !liked; likeCount = liked ? likeCount + 1 : likeCount - 1"
                                class="flex items-center gap-2 px-3 py-1.5 rounded-full transition-all duration-200"
                                :class="liked ? 'bg-pink-100 text-pink-600' : 'bg-gray-100 text-gray-500 hover:bg-pink-50 hover:text-pink-500'">
                                <svg class="w-4 h-4" :fill="liked ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="text-xs font-semibold" x-text="likeCount"></span>
                            </button>
                            
                            <span class="text-xs text-gray-400">
                                #{{ Str::limit(Str::slug($announcement->title, ''), 10, '') }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif


    {{-- Floating Social Media Buttons --}}
    <div class="fixed bottom-6 right-6 flex flex-col space-y-3 z-50">
        {{-- Linktree --}}
        @if($linktreeUrl = \App\Models\Setting::getValue('linktree_url'))
        <a href="{{ $linktreeUrl }}" target="_blank"
            class="w-12 h-12 bg-gray-900 hover:bg-gray-800 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110"
            title="Kunjungi Linktree Kami">
            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8.92 13.95l3.08-2.86 3.08 2.86 1.42-1.52-3.08-2.86 3.08-2.86-1.42-1.52L12 8.05 8.92 5.19 7.5 6.71l3.08 2.86-3.08 2.86 1.42 1.52zM12 16.4l-3.08 2.86L7.5 17.74 12 13.54l4.5 4.2-1.42 1.52L12 16.4z"/>
            </svg>
        </a>
        @endif
        {{-- WhatsApp --}}
        @if($whatsappNumber = \App\Models\Setting::getValue('school_whatsapp'))
        <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Assalamu\'alaikum Bapak/Ibu Panitia SPMB. Informasi pendaftaran Gelombang 1-3 tanggal berapa?') }}" target="_blank"
            class="w-14 h-14 bg-green-500 hover:bg-green-600 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 animate-pulse hover:animate-none"
            title="Hubungi via WhatsApp">
            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </a>
        @endif
    </div>

</body>
 <footer class="bg-white border-t border-gray-100 py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} {{ \App\Models\Setting::getValue('school_name') }}.
   
                   
</footer>

</html>
