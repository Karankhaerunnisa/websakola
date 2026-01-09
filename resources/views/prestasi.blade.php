<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prestasi - {{ \App\Models\Setting::getValue('school_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    @include('components.public-navbar')

    <div class="bg-gradient-to-r from-amber-500 to-orange-600 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Prestasi Kami</h1>
            <p class="text-amber-100">Berbagai pencapaian membanggakan dari siswa-siswi kami</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($prestasi as $item)
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden hover:shadow-lg transition">
                @if($item->photo)
                <img src="{{ asset('storage/prestasi/' . $item->photo) }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                    <x-heroicon-o-trophy class="w-20 h-20 text-white/50" />
                </div>
                @endif
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-3">
                        <span class="bg-purple-100 text-purple-700 text-xs font-medium px-2 py-1 rounded">{{ $categories[$item->category] ?? $item->category }}</span>
                        <span class="bg-blue-100 text-blue-700 text-xs font-medium px-2 py-1 rounded">{{ $levels[$item->level] ?? $item->level }}</span>
                        @if($item->rank)<span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded">{{ $item->rank }}</span>@endif
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item->title }}</h3>
                    @if($item->student_name)<p class="text-sm text-gray-600 mb-1"><x-heroicon-o-user class="w-4 h-4 inline mr-1" />{{ $item->student_name }}</p>@endif
                    @if($item->event_name)<p class="text-sm text-gray-500 mb-2">{{ $item->event_name }}</p>@endif
                    @if($item->achievement_date)<p class="text-xs text-gray-400"><x-heroicon-o-calendar class="w-3 h-3 inline mr-1" />{{ $item->achievement_date->format('d M Y') }}</p>@endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16"><p class="text-gray-500">Belum ada data prestasi.</p></div>
            @endforelse
        </div>
    </div>

    @include('components.public-footer')
</body>
</html>
