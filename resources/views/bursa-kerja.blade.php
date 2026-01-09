<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BKK - Bursa Kerja Khusus | {{ \App\Models\Setting::getValue('school_name') }}</title>
    <meta name="description" content="Bursa Kerja Khusus SMK Alghifari - Penempatan kerja dan informasi lowongan untuk alumni">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

{{-- Top Bar dengan Kontak dan Link --}}
<div class="bg-gray-100 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-8 text-xs">
            {{-- Left Side: Navigation Links --}}
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Beranda</a>
                <a href="{{ route('tentang-kami') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Tentang Kami</a>
                <a href="{{ route('bursa-kerja') }}" class="text-blue-600 font-medium transition">BKK</a>
                
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

{{-- HEADER --}}
<div class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold uppercase">Bursa Kerja Khusus (BKK)</h1>
                <p class="text-blue-100 mt-1">{{ \App\Models\Setting::getValue('school_name') }}</p>
            </div>
        </div>
    </div>
</div>

{{-- CONTENT --}}
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- KONTEN UTAMA --}}
        <div class="lg:col-span-2 space-y-8">
            
            {{-- Tentang BKK --}}
            <div class="bg-white p-6 border rounded-lg shadow-sm">
                <h2 class="text-xl font-bold border-b-2 border-yellow-500 pb-2 mb-4">
                    Tentang BKK SMK Alghifari
                </h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Bursa Kerja Khusus (BKK) SMK Alghifari adalah unit pelayanan yang mempertemukan 
                    pencari kerja (alumni) dengan perusahaan/industri yang membutuhkan tenaga kerja. 
                    BKK berperan sebagai jembatan antara dunia pendidikan dengan dunia kerja.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    BKK SMK Alghifari telah bekerjasama dengan berbagai perusahaan ternama baik di 
                    tingkat lokal, nasional, maupun internasional untuk menyalurkan lulusan yang 
                    kompeten dan siap kerja.
                </p>
            </div>

            {{-- Layanan BKK --}}
            <div class="bg-white p-6 border rounded-lg shadow-sm">
                <h2 class="text-xl font-bold border-b-2 border-yellow-500 pb-2 mb-4">
                    Layanan BKK
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3 p-4 bg-blue-50 rounded-lg">
                        <div class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Pendaftaran Pencari Kerja</h3>
                            <p class="text-sm text-gray-600">Registrasi alumni untuk database pencari kerja</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 p-4 bg-green-50 rounded-lg">
                        <div class="w-10 h-10 bg-green-600 text-white rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Informasi Lowongan</h3>
                            <p class="text-sm text-gray-600">Update terbaru lowongan kerja dari mitra</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 p-4 bg-amber-50 rounded-lg">
                        <div class="w-10 h-10 bg-amber-600 text-white rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Rekrutmen Perusahaan</h3>
                            <p class="text-sm text-gray-600">Fasilitasi rekrutmen langsung di sekolah</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 p-4 bg-purple-50 rounded-lg">
                        <div class="w-10 h-10 bg-purple-600 text-white rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Bimbingan Karir</h3>
                            <p class="text-sm text-gray-600">Pelatihan soft skill dan persiapan kerja</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Statistik Penempatan --}}
            <div class="bg-white p-6 border rounded-lg shadow-sm">
                <h2 class="text-xl font-bold border-b-2 border-yellow-500 pb-2 mb-4">
                    Statistik Penempatan Kerja
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl text-white">
                        <div class="text-3xl font-bold">500+</div>
                        <div class="text-sm text-blue-100">Alumni Tersalur</div>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-br from-green-500 to-green-600 rounded-xl text-white">
                        <div class="text-3xl font-bold">50+</div>
                        <div class="text-sm text-green-100">Perusahaan Mitra</div>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl text-white">
                        <div class="text-3xl font-bold">85%</div>
                        <div class="text-sm text-amber-100">Tingkat Keterserapan</div>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl text-white">
                        <div class="text-3xl font-bold">10+</div>
                        <div class="text-sm text-purple-100">Tahun Pengalaman</div>
                    </div>
                </div>
            </div>

            {{-- Mitra Perusahaan --}}
            <div class="bg-white p-6 border rounded-lg shadow-sm">
                <h2 class="text-xl font-bold border-b-2 border-yellow-500 pb-2 mb-4">
                    Mitra Perusahaan
                </h2>
                <p class="text-gray-700 mb-4">
                    BKK SMK Alghifari telah menjalin kerjasama dengan berbagai perusahaan ternama:
                </p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="p-4 bg-gray-50 rounded-lg text-center border">
                        <div class="font-semibold text-gray-800">PT. Astra Honda Motor</div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg text-center border">
                        <div class="font-semibold text-gray-800">PT. Toyota Indonesia</div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg text-center border">
                        <div class="font-semibold text-gray-800">Apotek Kimia Farma</div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg text-center border">
                        <div class="font-semibold text-gray-800">Bank BRI</div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg text-center border">
                        <div class="font-semibold text-gray-800">PT. Telkom Indonesia</div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg text-center border">
                        <div class="font-semibold text-gray-800">Indomaret</div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg text-center border">
                        <div class="font-semibold text-gray-800">Alfamart</div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg text-center border">
                        <div class="font-semibold text-gray-800">Dan lainnya...</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-6">

            {{-- Contact BKK --}}
            <div class="bg-white p-6 border rounded-lg shadow-sm">
                <h3 class="font-bold border-b-2 border-yellow-500 pb-2 mb-4">
                    Hubungi BKK
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Telepon</div>
                            <div class="font-medium">{{ \App\Models\Setting::getValue('school_phone', '0262-448446') }}</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">WhatsApp</div>
                            <div class="font-medium">{{ \App\Models\Setting::getValue('school_whatsapp', '628123456789') }}</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Email</div>
                            <div class="font-medium text-sm">bkk@smkalghifari.sch.id</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Lowongan Terbaru --}}
            <div class="bg-white p-6 border rounded-lg shadow-sm">
                <h3 class="font-bold border-b-2 border-yellow-500 pb-2 mb-4">
                    Lowongan Terbaru
                </h3>
                <div class="space-y-4">
                    <div class="p-3 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                        <div class="font-semibold text-sm">Operator Produksi</div>
                        <div class="text-xs text-gray-500">PT. Astra Honda Motor</div>
                        <div class="text-xs text-blue-600 mt-1">Lulusan TKR/TSM</div>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg border-l-4 border-green-500">
                        <div class="font-semibold text-sm">Staff Admin</div>
                        <div class="text-xs text-gray-500">Indomaret</div>
                        <div class="text-xs text-blue-600 mt-1">Lulusan AKL/MP</div>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg border-l-4 border-purple-500">
                        <div class="font-semibold text-sm">Asisten Apoteker</div>
                        <div class="text-xs text-gray-500">Apotek Kimia Farma</div>
                        <div class="text-xs text-blue-600 mt-1">Lulusan Farmasi</div>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg border-l-4 border-amber-500">
                        <div class="font-semibold text-sm">IT Support</div>
                        <div class="text-xs text-gray-500">PT. Telkom Indonesia</div>
                        <div class="text-xs text-blue-600 mt-1">Lulusan RPL</div>
                    </div>
                </div>
            </div>

            {{-- Pendaftaran Alumni --}}
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 p-6 rounded-lg shadow-sm text-white">
                <h3 class="font-bold pb-2 mb-4">
                    Daftar Pencari Kerja
                </h3>
                <p class="text-sm text-blue-100 mb-4">
                    Alumni SMK Alghifari? Daftarkan diri Anda untuk mendapatkan informasi lowongan kerja terbaru.
                </p>
                <a href="https://wa.me/{{ \App\Models\Setting::getValue('school_whatsapp', '628123456789') }}?text=Halo%20BKK%20SMK%20Alghifari,%20saya%20ingin%20mendaftar%20sebagai%20pencari%20kerja" 
                    target="_blank"
                    class="block w-full bg-white text-blue-700 text-center py-3 rounded-lg font-bold hover:bg-gray-100 transition">
                    Daftar Sekarang
                </a>
            </div>

        </div>
    </div>
</div>

@include('components.public-footer')

</body>
</html>
