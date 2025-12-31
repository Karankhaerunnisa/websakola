<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">

        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 md:hidden"></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-white transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0 md:flex md:flex-col transform">

            <div class="p-4 border-b border-gray-800 flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <x-heroicon-o-building-library class="w-8 h-8 text-blue-500" />
                    <div>
                        <h1 class="text-lg font-bold">SPMB Admin</h1>
                        <p class="text-xs text-gray-400">SMK Al-Ghifari Banyuresmi</p>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white">
                    <x-heroicon-o-x-mark class="w-6 h-6" />
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <x-heroicon-o-squares-2x2 class="w-5 h-5 mr-3" />
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.registrants.index') }}"
                            class="flex items-center px-4 py-3 {{ request()->routeIs('admin.registrants.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <x-heroicon-o-user-group class="w-5 h-5 mr-3" />
                            Data Pendaftar
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.majors.index') }}"
                            class="flex items-center px-4 py-3 {{ request()->routeIs('admin.majors.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <x-heroicon-o-academic-cap class="w-5 h-5 mr-3" />
                            Kelola Jurusan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.announcements.index') }}"
                            class="flex items-center px-4 py-3 {{ request()->routeIs('admin.announcements.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <x-heroicon-o-megaphone class="w-5 h-5 mr-3" />
                            Pengumuman
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pengumuman-ujian.index') }}"
                            class="flex items-center px-4 py-3 {{ request()->routeIs('admin.pengumuman-ujian.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <x-heroicon-o-megaphone class="w-5 h-5 mr-3" />
                            Pengumuman Seleksi SPMB
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings.index') }}"
                            class="flex items-center px-4 py-3 {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <x-heroicon-o-cog-6-tooth class="w-5 h-5 mr-3" />
                            Pengaturan
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center px-4 py-3 text-gray-400 hover:bg-red-600 hover:text-white transition-colors">
                                <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5 mr-3" />
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 relative z-10">

                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none md:hidden mr-4">
                        <x-heroicon-o-bars-3 class="w-6 h-6" />
                    </button>

                    <h2 class="text-xl font-bold text-gray-800">
                        @yield('title', 'Dashboard')
                    </h2>
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.outside="open = false"
                        class="flex items-center space-x-3 focus:outline-none">

                        <div class="text-right hidden sm:block">
                            <div class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div
                            class="h-10 w-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold shrink-0">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>

                        <x-heroicon-o-chevron-down x-show="!open" class="w-4 h-4 text-gray-400" />
                        <x-heroicon-o-chevron-up x-show="open" class="w-4 h-4 text-gray-600" style="display: none;" />
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-20"
                        style="display: none;">

                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" @click="open = false"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                <x-heroicon-o-user class="w-5 h-5 mr-2 text-blue-500" />
                                Kelola Profil
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" @click="open = false"
                                    class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5 mr-2 text-red-500" />
                                    Keluar (Logout)
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
