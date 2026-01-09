<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mitra Kerjasama - {{ \App\Models\Setting::getValue('school_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    @include('components.public-navbar')

    <div class="bg-gradient-to-r from-slate-700 to-slate-900 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Mitra Kerjasama</h1>
            <p class="text-slate-300">Kemitraan strategis dengan dunia industri dan institusi untuk masa depan siswa</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($mitra as $item)
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden hover:shadow-lg transition group p-6 text-center">
                <div class="flex items-center justify-center h-24 mb-4">
                    @if($item->logo)
                    <img src="{{ asset('storage/mitra/' . $item->logo) }}" class="max-h-20 max-w-full object-contain group-hover:scale-110 transition-transform">
                    @else
                    <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center">
                        <x-heroicon-o-building-office class="w-10 h-10 text-blue-600" />
                    </div>
                    @endif
                </div>
                <h3 class="font-bold text-gray-900 mb-1">{{ $item->name }}</h3>
                <span class="text-xs text-gray-500">{{ $categories[$item->category] ?? $item->category }}</span>
                @if($item->partnership_type)<p class="text-xs text-blue-600 mt-2">{{ $partnershipTypes[$item->partnership_type] ?? $item->partnership_type }}</p>@endif
                @if($item->website)<a href="{{ $item->website }}" target="_blank" class="inline-block mt-3 text-xs text-blue-600 hover:underline">Kunjungi Website</a>@endif
            </div>
            @empty
            <div class="col-span-full text-center py-16"><p class="text-gray-500">Belum ada data mitra.</p></div>
            @endforelse
        </div>
    </div>

    @include('components.public-footer')
</body>
</html>
