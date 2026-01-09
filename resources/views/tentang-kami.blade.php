<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil & Sambutan - {{ \App\Models\Setting::getValue('school_name','SMK Al-Ghifari Banyuresmi') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 text-gray-800">

{{-- TOP BAR --}}
<div class="bg-gray-100 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-8 text-xs">
            <div class="hidden md:flex space-x-4">
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('tentang-kami') }}" class="text-blue-600 font-semibold">Tentang Kami</a>
                <a href="{{ route('bursa-kerja') }}">BKK</a>
            </div>
            <div class="flex space-x-4 ml-auto">
                <span>{{ \App\Models\Setting::getValue('school_phone') }}</span>
                <span>{{ \App\Models\Setting::getValue('school_email') }}</span>
            </div>
        </div>
    </div>
</div>

{{-- HEADER --}}
<div class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 py-6 flex items-center gap-4">
        <img src="{{ asset('images/' . \App\Models\Setting::getValue('app_logo','default.png')) }}"
             class="h-16">
        <h1 class="text-3xl font-bold uppercase">
            {{ \App\Models\Setting::getValue('school_name','SMK Al-Ghifari Banyuresmi') }}
        </h1>
    </div>
</div>

{{-- ================= SAMBUTAN + PROFIL ================= --}}
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- SAMBUTAN --}}
        <div class="lg:col-span-2 bg-white p-8 border rounded">
            <h2 class="text-xl font-bold border-b-2 border-yellow-500 pb-2 mb-4">
                Sambutan Kepala Sekolah
            </h2>

            <p class="mb-4">
                <span class="text-3xl font-bold text-teal-600">A</span>
                ssalamu’alaikum Warahmatullahi Wabarakatuh,
            </p>

            <p class="mb-4 text-justify">
               Puji syukur saya panjatkan ke hadirat Allah SWT karena berkat rahmat-Nya, website resmi SMK ini dapat kami hadirkan. Website ini kami buat sebagai sarana informasi dan komunikasi bagi seluruh warga sekolah, orang tua, serta masyarakat luas. Melalui media ini, saya berharap semua pihak dapat mengetahui berbagai kegiatan, prestasi, dan program unggulan yang kami laksanakan di sekolah, sekaligus menjalin hubungan yang lebih erat dengan dunia usaha dan industri.

Sebagai Kepala Sekolah, 
            </p>

            <p class="mb-4 text-justify">
                saya berkomitmen untuk terus meningkatkan kualitas pendidikan dan pelayanan, sehingga lulusan SMK kita mampu bersaing dan memiliki karakter yang kuat. Dukungan dari seluruh tenaga pendidik, siswa, dan mitra industri menjadi kekuatan utama kami dalam mewujudkan visi sekolah. Semoga website ini bermanfaat sebagai sumber informasi yang lengkap dan dapat menjadi jembatan komunikasi yang positif bagi semua pihak.


            </p>

            <p class="font-semibold mt-6">
                Wassalamu’alaikum Warahmatullahi Wabarakatuh.
            </p>

            <p class="mt-4 font-bold">
                Hasan Taufan Rahman, S.Pd., M.Pd., 
            </p>
        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-6">

            {{-- MAP --}}
            <div class="bg-white p-3 border rounded">
                <iframe
                    src="https://www.google.com/maps?q=Jl.+Hasan+Arif+Km.10+Karees+Garut&output=embed"
                    class="w-full h-48 border"
                    loading="lazy">
                </iframe>
            </div>

            {{-- PROFIL SEKOLAH --}}
            <div class="bg-white p-6 border rounded">
                <table class="w-full text-sm border">
                    <tr class="border-b">
                        <td class="bg-gray-100 p-2 font-semibold">Alamat</td>
                        <td class="p-2">Jl. Hasan Arif Km.10 Karees, Kab. Garut</td>
                    </tr>
                    <tr class="border-b">
                        <td class="bg-gray-100 p-2 font-semibold">NPSN</td>
                        <td class="p-2">20257237</td>
                    </tr>
                    <tr class="border-b">
                        <td class="bg-gray-100 p-2 font-semibold">Status</td>
                        <td class="p-2">Swasta</td>
                    </tr>
                    <tr class="border-b">
                        <td class="bg-gray-100 p-2 font-semibold">Jenjang</td>
                        <td class="p-2">SMK Pusat Keunggalan (PK)</td>
                    </tr>
                    <tr class="border-b">
                        <td class="bg-gray-100 p-2 font-semibold">Kurikulum</td>
                        <td class="p-2">Merdeka</td>
                    </tr>
                    <tr class="border-b">
                        <td class="bg-gray-100 p-2 font-semibold">Akreditasi</td>
                        <td class="p-2">A</td>
                    </tr>
                    <tr>
                        <td class="bg-gray-100 p-2 font-semibold">Berdiri</td>
                        <td class="p-2">2009</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- ================= VISI MISI SLOGAN ================= --}}
<div class="max-w-7xl mx-auto px-4 pb-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- VISI --}}
        <div class="bg-white border p-6 rounded text-center">
            <h3 class="font-bold text-lg mb-3 border-b pb-2">Visi</h3>
            <p>
                Terwujudnya lulusan yang beriman, berakhlak mulia,
                kompeten dan siap kerja.
            </p>
        </div>

        {{-- MISI --}}
        <div class="bg-white border p-6 rounded">
            <h3 class="font-bold text-lg mb-3 border-b pb-2 text-center">Misi</h3>
            <ul class="list-decimal list-inside space-y-1 text-sm">
                <li>Pendidikan berbasis kompetensi</li>
                <li>Penguatan karakter dan keislaman</li>
                <li>Kerja sama dunia industri</li>
                <li>Peningkatan mutu layanan</li>
            </ul>
        </div>

        {{-- SLOGAN --}}
        <div class="bg-white border p-6 rounded text-center">
            <h3 class="font-bold text-lg mb-3 border-b pb-2">Slogan</h3>
            <p class="text-xl font-semibold text-teal-600">
                “Berilmu, Berakhlak, Siap Kerja”
            </p>
        </div>

    </div>
</div>

@include('components.public-footer')

</body>
</html>
