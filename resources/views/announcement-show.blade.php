<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $announcement->title }} - {{ \App\Models\Setting::getValue('school_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased min-h-screen flex flex-col">

    
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
