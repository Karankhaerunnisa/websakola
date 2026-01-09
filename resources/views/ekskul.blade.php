<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ekstrakurikuler - {{ \App\Models\Setting::getValue('school_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    @include('components.public-navbar')

    <div class="bg-gradient-to-r from-purple-600 to-pink-600 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Ekstrakurikuler</h1>
            <p class="text-purple-100">Wadah pengembangan minat dan bakat siswa di luar jam pelajaran</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($ekskul as $item)
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden hover:shadow-lg transition group">
                @if($item->photo)
                <img src="{{ asset('storage/ekskul/' . $item->photo) }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                <div class="w-full h-48 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                    <x-heroicon-o-academic-cap class="w-20 h-20 text-white/50" />
                </div>
                @endif
                <div class="p-6">
                    <span class="bg-purple-100 text-purple-700 text-xs font-medium px-2 py-1 rounded">{{ $categories[$item->category] ?? $item->category }}</span>
                    <h3 class="text-xl font-bold text-gray-900 mt-3 mb-2">{{ $item->name }}</h3>
                    @if($item->schedule)<div class="flex items-center text-sm text-gray-500 mb-1"><x-heroicon-o-clock class="w-4 h-4 mr-2" />{{ $item->schedule }}</div>@endif
                    @if($item->instructor)<div class="flex items-center text-sm text-gray-500 mb-3"><x-heroicon-o-user class="w-4 h-4 mr-2" />{{ $item->instructor }}</div>@endif
                    @if($item->description)<p class="text-sm text-gray-600 line-clamp-2">{{ $item->description }}</p>@endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16"><p class="text-gray-500">Belum ada data ekstrakurikuler.</p></div>
            @endforelse
        </div>
    </div>

    @include('components.public-footer')
</body>
</html>
