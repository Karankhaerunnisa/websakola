<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Berhasil - {{ \App\Models\Setting::getValue('school_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased min-h-screen flex flex-col">

    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="font-bold text-blue-900 text-lg">{{ \App\Models\Setting::getValue('school_name') }}</div>
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-blue-600">Kembali ke Beranda</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-2xl w-full border border-gray-100">

            <div class="bg-green-50 p-8 text-center border-b border-green-100">
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                    <x-heroicon-o-check-circle class="h-12 w-12 text-green-600" />
                </div>
                <h1 class="text-3xl font-extrabold text-green-800 mb-2">Pendaftaran Berhasil!</h1>
                <p class="text-green-700">Data Anda telah berhasil disimpan dalam sistem kami.</p>
            </div>

            <div class="p-8 space-y-6">

                <div class="bg-blue-50 rounded-lg p-6 border border-blue-100 text-center">
                    <p class="text-sm text-blue-600 font-semibold uppercase tracking-wider mb-1">Nomor Pendaftaran Anda
                    </p>
                    <div class="text-4xl font-mono font-bold text-blue-900 tracking-widest my-2 select-all">
                        {{ $registrant->registration_number }}
                    </div>
                    <p class="text-xs text-blue-500">
                        *Simpan nomor ini untuk mengecek status kelulusan Anda nanti.
                    </p>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500">Nama Lengkap</span>
                        <span class="font-medium text-gray-900">{{ $registrant->name }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500">Jurusan Dipilih</span>
                        <span class="font-medium text-gray-900">{{ $registrant->major->name }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500">Tanggal Daftar</span>
                        <span class="font-medium text-gray-900">{{ $registrant->created_at->format('d F Y H:i')
                            }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                    <a href="{{ route('registration.print', $registrant->registration_number) }}" target="_blank"
                        class="flex items-center justify-center w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                        <x-heroicon-o-printer class="w-5 h-5 mr-2" />
                        Cetak Bukti Daftar
                    </a>

                    <a href="{{ route('registration.check-status.form') }}"
                        class="flex items-center justify-center w-full bg-white border border-gray-300 text-gray-700 font-bold py-3 rounded-lg hover:bg-gray-50 transition">
                        <x-heroicon-o-clipboard-document-check class="w-5 h-5 mr-2" />
                        Cek Status
                    </a>
                </div>

            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} {{ \App\Models\Setting::getValue('school_name') }}.
    </footer>

</body>

</html>
