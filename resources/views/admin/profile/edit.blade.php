@extends('layouts.admin')

@section('title', 'Kelola Profil')

@section('content')

    <div class="space-y-6">

        <div class="p-4 sm:p-8 bg-white shadow-sm border border-gray-100 sm:rounded-lg">
            <div class="max-w-xl">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Profil</h3>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow-sm border border-gray-100 sm:rounded-lg">
            <div class="max-w-xl">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Update Password</h3>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow-sm border border-gray-100 sm:rounded-lg">
            <div class="max-w-xl">
                <h3 class="text-lg font-medium text-red-600 mb-4">Hapus Akun</h3>
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>

@endsection
