<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $major->name }} - {{ \App\Models\Setting::getValue('school_name') }}</title>
    <meta name="description" content="{{ Str::limit(strip_tags($major->content ?? $major->description), 160) }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased">

{{-- Hero Section --}}
<div class="bg-gradient-to-r from-blue-700 via-indigo-700 to-purple-700 text-white">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex flex-col md:flex-row items-center gap-8">
            {{-- Icon/Logo Jurusan --}}
            <div class="w-24 h-24 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                @php
                    $iconMap = [
                        'RPL' => 'code-bracket',
                        'AKL' => 'calculator',
                        'MP' => 'building-office',
                        'TKR' => 'wrench-screwdriver',
                        'TSM' => 'cog-6-tooth',
                        'FARMASI' => 'beaker',
                    ];
                    $iconName = $iconMap[strtoupper($major->code)] ?? 'academic-cap';
                @endphp
                <x-dynamic-component :component="'heroicon-o-' . $iconName" class="w-12 h-12 text-white" />
            </div>
            
            <div class="text-center md:text-left">
                <span class="inline-block bg-white/20 text-white text-sm font-medium px-3 py-1 rounded-full mb-3">
                    Kode: {{ $major->code }}
                </span>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $major->name }}</h1>
                <p class="text-blue-100 text-lg">{{ $major->description }}</p>
                
                <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-4">
                    <div class="bg-white/10 px-4 py-2 rounded-lg">
                        <span class="text-sm text-blue-200">Kuota</span>
                        <div class="font-bold text-xl">{{ $major->quota }} Siswa</div>
                    </div>
                    <div class="bg-white/10 px-4 py-2 rounded-lg">
                        <span class="text-sm text-blue-200">Pendaftar</span>
                        <div class="font-bold text-xl">{{ $major->registrants_count ?? 0 }} Siswa</div>
                    </div>
                    <div class="bg-white/10 px-4 py-2 rounded-lg">
                        <span class="text-sm text-blue-200">Sisa Kuota</span>
                        <div class="font-bold text-xl">{{ $major->quota - ($major->registrants_count ?? 0) }} Siswa</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Breadcrumb --}}
<div class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900 font-medium">{{ $major->name }}</span>
        </nav>
    </div>
</div>

{{-- Content Section --}}
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-8">
            
            {{-- Deskripsi / Blog Content --}}
            <div class="bg-white rounded-xl shadow-sm border p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-4">
                    Tentang Program Keahlian {{ $major->name }}
                </h2>
                
                @if($major->content)
                <div class="prose prose-blue max-w-none">
                    {!! $major->content !!}
                </div>
                @else
                <div class="text-gray-500 italic">
                    Konten belum tersedia. Silakan hubungi admin untuk menambahkan informasi tentang jurusan ini.
                </div>
                @endif
            </div>

            {{-- Photo Gallery --}}
            @if($major->photo1 || $major->photo2)
            <div class="bg-white rounded-xl shadow-sm border p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Galeri Foto</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($major->photo1)
                    <div class="group relative overflow-hidden rounded-xl shadow-lg">
                        <img src="{{ asset('storage/majors/' . $major->photo1) }}" 
                            alt="Foto {{ $major->name }} 1" 
                            class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    @endif
                    
                    @if($major->photo2)
                    <div class="group relative overflow-hidden rounded-xl shadow-lg">
                        <img src="{{ asset('storage/majors/' . $major->photo2) }}" 
                            alt="Foto {{ $major->name }} 2" 
                            class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- YouTube Video --}}
            @if($major->youtube_url)
            <div class="bg-white rounded-xl shadow-sm border p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Video Profil Jurusan</h3>
                <div class="aspect-video rounded-xl overflow-hidden shadow-lg">
                    @php
                        // Extract YouTube video ID from URL
                        $youtubeId = '';
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $major->youtube_url, $matches)) {
                            $youtubeId = $matches[1];
                        }
                    @endphp
                    @if($youtubeId)
                    <iframe 
                        src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                        class="w-full h-full"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                    @else
                    <a href="{{ $major->youtube_url }}" target="_blank" 
                        class="flex items-center justify-center w-full h-full bg-gray-100 hover:bg-gray-200 transition">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto text-red-600 mb-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            <span class="text-gray-600 font-medium">Tonton di YouTube</span>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            
            {{-- CTA Daftar --}}
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl p-6 text-white shadow-lg">
                <h3 class="text-xl font-bold mb-3">Tertarik dengan Jurusan Ini?</h3>
                <p class="text-blue-100 text-sm mb-4">Daftarkan dirimu sekarang dan jadilah bagian dari {{ $major->name }}!</p>
                <a href="{{ route('formulir') }}" 
                    class="block w-full bg-white text-blue-700 text-center py-3 rounded-lg font-bold hover:bg-gray-100 transition">
                    Daftar Sekarang
                </a>
            </div>

            {{-- Info Jurusan --}}
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h3 class="font-bold text-gray-900 border-b pb-3 mb-4">Informasi Jurusan</h3>
                <div class="space-y-4">
                    <div>
                        <span class="text-sm text-gray-500">Kode Jurusan</span>
                        <div class="font-bold text-blue-600">{{ $major->code }}</div>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Nama Jurusan</span>
                        <div class="font-medium text-gray-900">{{ $major->name }}</div>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Status</span>
                        <div>
                            @if($major->is_active)
                            <span class="inline-flex items-center bg-green-100 text-green-700 text-xs font-medium px-2 py-1 rounded-full">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                Aktif
                            </span>
                            @else
                            <span class="inline-flex items-center bg-red-100 text-red-700 text-xs font-medium px-2 py-1 rounded-full">
                                <span class="w-2 h-2 bg-red-500 rounded-full mr-1"></span>
                                Tidak Aktif
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Jurusan Lainnya --}}
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h3 class="font-bold text-gray-900 border-b pb-3 mb-4">Jurusan Lainnya</h3>
                <div class="space-y-3">
                    @foreach($otherMajors as $other)
                    <a href="{{ route('jurusan.show', $other) }}" 
                        class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition group">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200 transition">
                            <span class="text-blue-600 font-bold text-xs">{{ $other->code }}</span>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 text-sm group-hover:text-blue-600 transition">{{ $other->name }}</div>
                            <div class="text-xs text-gray-500">Kuota: {{ $other->quota }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Hubungi Kami --}}
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h3 class="font-bold text-gray-900 border-b pb-3 mb-4">Ada Pertanyaan?</h3>
                <p class="text-sm text-gray-600 mb-4">Hubungi kami untuk informasi lebih lanjut tentang jurusan ini.</p>
                <a href="https://wa.me/{{ \App\Models\Setting::getValue('school_whatsapp', '628123456789') }}?text=Halo,%20saya%20ingin%20bertanya%20tentang%20jurusan%20{{ urlencode($major->name) }}" 
                    target="_blank"
                    class="flex items-center justify-center w-full bg-green-500 text-white py-3 rounded-lg font-medium hover:bg-green-600 transition">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

@include('components.public-footer')

</body>
</html>
