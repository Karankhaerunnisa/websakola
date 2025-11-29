<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $announcement->title }} - {{ \App\Models\Setting::getValue('school_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased min-h-screen flex flex-col">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/' . \App\Models\Setting::getValue('app_logo', 'default.png')) }}"
                            class="h-8 w-auto">
                        <div class="font-bold text-blue-900 text-lg hidden sm:block">{{
                            \App\Models\Setting::getValue('school_name') }}</div>
                    </a>
                </div>
                <div>
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium text-gray-600 hover:text-blue-600 flex items-center">
                        <x-heroicon-o-arrow-left class="w-4 h-4 mr-1" />
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">

        <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-100 bg-gray-50">
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                    <x-heroicon-o-calendar class="w-4 h-4" />
                    {{ $announcement->published_at ? $announcement->published_at->format('d F Y') :
                    $announcement->created_at->format('d F Y') }}
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900 leading-tight">
                    {{ $announcement->title }}
                </h1>
            </div>

            <div class="p-8 prose max-w-none text-gray-700 leading-relaxed whitespace-pre-wrap">
                {{-- nl2br allows line breaks from the textarea to show as paragraphs --}}
                {!! nl2br(e($announcement->content)) !!}
            </div>
        </article>

    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} {{ \App\Models\Setting::getValue('school_name') }}.
    </footer>

</body>

</html>
