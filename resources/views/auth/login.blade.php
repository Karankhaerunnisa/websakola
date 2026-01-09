@extends('layouts.guest')

@section('title', 'Login Administrator')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">

    <div class="mb-8 text-center">
        @php
        // Fetch dynamic logo and name
        $logo = \App\Models\Setting::getValue('app_logo', 'default.png');
        $schoolName = \App\Models\Setting::getValue('school_name', 'SMK Al-Ghifari Banyuresmi');
        @endphp

        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/' . $logo) }}" alt="Logo" class="h-20 w-auto object-contain drop-shadow-sm">
        </div>
        <h1 class="text-2xl font-bold text-gray-900">{{ $schoolName }}</h1>
        
    </div>

    <div class="w-full sm:max-w-md bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
        <div class="p-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-6 text-center border-b pb-4">
                Login Administrator
            </h2>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <x-heroicon-o-envelope class="h-5 w-5 text-gray-400" />
                        </div>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username"
                            class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5"
                            placeholder="admin@sekolah.sch.id">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <x-heroicon-o-lock-closed class="h-5 w-5 text-gray-400" />
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5"
                            placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mt-4 mb-6">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white font-bold py-2.5 rounded-md hover:bg-blue-700 transition duration-150 ease-in-out shadow-sm flex justify-center items-center">
                    <x-heroicon-o-arrow-right-on-rectangle class="h-5 w-5 mr-2" />
                    Masuk ke Dashboard
                </button>
            </form>
        </div>

       
    </div>

    <div class="mt-6">
        <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-blue-600 flex items-center justify-center transition">
            <x-heroicon-o-arrow-left class="w-4 h-4 mr-1" />
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
