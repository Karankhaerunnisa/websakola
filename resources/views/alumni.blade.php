<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni - {{ \App\Models\Setting::getValue('school_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    @include('components.public-navbar')

    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Alumni Kami</h1>
            <p class="text-blue-100">Jejak sukses alumni yang telah berkarya di berbagai bidang</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($alumni as $item)
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden hover:shadow-lg transition group">
                <div class="relative">
                    @if($item->photo)
                    <img src="{{ asset('storage/alumni/' . $item->photo) }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                        <x-heroicon-o-user class="w-20 h-20 text-white/50" />
                    </div>
                    @endif
                    <div class="absolute top-4 right-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">{{ $item->graduation_year }}</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $item->name }}</h3>
                    @if($item->major)<p class="text-sm text-blue-600 mb-3">{{ $item->major }}</p>@endif
                    @if($item->current_position || $item->company)
                    <div class="flex items-center text-sm text-gray-600 mb-3">
                        <x-heroicon-o-briefcase class="w-4 h-4 mr-2" />
                        {{ $item->current_position }}{{ $item->company ? ' di ' . $item->company : '' }}
                    </div>
                    @endif
                    @if($item->testimonial)
                    <p class="text-sm text-gray-500 italic">"{{ Str::limit($item->testimonial, 100) }}"</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16"><p class="text-gray-500">Belum ada data alumni.</p></div>
            @endforelse
        </div>
    </div>

    @include('components.public-footer')
</body>
</html>
