{{-- Main Navbar --}}
<nav x-data="{ open: false }" class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/' . \App\Models\Setting::getValue('app_logo', 'default.png')) }}" class="h-10 w-auto" alt="Logo">
                <div>
                    <div class="font-bold text-blue-900 leading-tight">{{ \App\Models\Setting::getValue('school_name') }}</div>
                    <div class="text-xs text-gray-500">SPMB Online {{ \App\Models\Setting::getValue('academic_year') }}</div>
                </div>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition"><x-heroicon-o-home class="w-4 h-4 mr-1" />Beranda</a>
                <a href="{{ route('alumni') }}" class="text-sm font-medium {{ request()->routeIs('alumni') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition"><x-heroicon-o-users class="w-4 h-4 mr-1" />Alumni</a>
                <a href="{{ route('prestasi') }}" class="text-sm font-medium {{ request()->routeIs('prestasi') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition"><x-heroicon-o-trophy class="w-4 h-4 mr-1" />Prestasi</a>
                <a href="{{ route('ekskul') }}" class="text-sm font-medium {{ request()->routeIs('ekskul') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition"><x-heroicon-o-academic-cap class="w-4 h-4 mr-1" />Ekskul</a>
                <a href="{{ route('kegiatan') }}" class="text-sm font-medium {{ request()->routeIs('kegiatan') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition"><x-heroicon-o-calendar-days class="w-4 h-4 mr-1" />Kegiatan</a>
                <a href="{{ route('mitra') }}" class="text-sm font-medium {{ request()->routeIs('mitra') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition"><x-heroicon-o-building-office class="w-4 h-4 mr-1" />Mitra</a>
            </div>

            <div class="-mr-2 flex items-center md:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <x-heroicon-o-bars-3 class="h-6 w-6" x-show="!open" />
                    <x-heroicon-o-x-mark class="h-6 w-6" x-show="open" style="display: none;" />
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" class="md:hidden border-t border-gray-100 bg-white" style="display: none;">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }}">Beranda</a>
            
            <a href="{{ route('alumni') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('alumni') ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }}">Alumni</a>
            <a href="{{ route('prestasi') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('prestasi') ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }}">Prestasi</a>
            <a href="{{ route('ekskul') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('ekskul') ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }}">Ekskul</a>
            <a href="{{ route('kegiatan') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('kegiatan') ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }}">Kegiatan</a>
            <a href="{{ route('mitra') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('mitra') ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }}">Mitra</a>
        </div>
    </div>
</nav>
