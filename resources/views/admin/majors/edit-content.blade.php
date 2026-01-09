@extends('layouts.admin')

@section('title', 'Edit Konten Jurusan - ' . $major->name)

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.majors.index') }}" class="text-sm text-blue-600 hover:text-blue-700 flex items-center">
        <x-heroicon-o-arrow-left class="w-4 h-4 mr-1" />
        Kembali ke Daftar Jurusan
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
    <div class="bg-gray-50 px-6 py-4 border-b">
        <h2 class="text-lg font-bold text-gray-900">
            Edit Konten Jurusan: {{ $major->name }} ({{ $major->code }})
        </h2>
        <p class="text-sm text-gray-500 mt-1">Kelola konten halaman detail jurusan untuk tampilan publik</p>
    </div>

    <form action="{{ route('admin.majors.update-content', $major->code) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        @method('PUT')

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Info Dasar --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-gray-50 rounded-lg">
            <div>
                <span class="text-xs text-gray-500">Kode Jurusan</span>
                <div class="font-bold text-blue-600">{{ $major->code }}</div>
            </div>
            <div>
                <span class="text-xs text-gray-500">Nama Jurusan</span>
                <div class="font-medium text-gray-900">{{ $major->name }}</div>
            </div>
            <div>
                <span class="text-xs text-gray-500">Kuota</span>
                <div class="font-medium text-gray-900">{{ $major->quota }} Siswa</div>
            </div>
        </div>

        {{-- Konten Blog --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Konten Halaman Jurusan (HTML)
                <span class="text-xs text-gray-400 font-normal ml-2">Mendukung format HTML</span>
            </label>
            <textarea name="content" rows="15" 
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm font-mono"
                placeholder="Masukkan konten HTML untuk halaman jurusan...">{!! old('content', $major->content) !!}</textarea>
            <p class="text-xs text-gray-500 mt-1">
                Tips: Gunakan tag HTML seperti &lt;p&gt;, &lt;h3&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;strong&gt;, &lt;em&gt; untuk memformat konten.
            </p>
        </div>

        {{-- Link YouTube --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Link Video YouTube
            </label>
            <input type="url" name="youtube_url" value="{{ old('youtube_url', $major->youtube_url) }}"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                placeholder="https://www.youtube.com/watch?v=xxxxx atau https://youtu.be/xxxxx">
            <p class="text-xs text-gray-500 mt-1">
                Masukkan link video YouTube untuk profil jurusan (opsional)
            </p>
        </div>

        {{-- Upload Foto --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Foto 1 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Foto 1
                </label>
                @if($major->photo1)
                <div class="mb-3">
                    <img src="{{ asset('storage/majors/' . $major->photo1) }}" 
                        alt="Foto 1" class="w-full h-40 object-cover rounded-lg border">
                    <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                </div>
                @endif
                <input type="file" name="photo1" accept="image/*"
                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Maks: 2MB)</p>
            </div>

            {{-- Foto 2 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Foto 2
                </label>
                @if($major->photo2)
                <div class="mb-3">
                    <img src="{{ asset('storage/majors/' . $major->photo2) }}" 
                        alt="Foto 2" class="w-full h-40 object-cover rounded-lg border">
                    <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                </div>
                @endif
                <input type="file" name="photo2" accept="image/*"
                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Maks: 2MB)</p>
            </div>
        </div>

        {{-- Preview Link --}}
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="font-medium text-blue-900">Preview Halaman Jurusan</h4>
                    <p class="text-sm text-blue-700">Lihat tampilan halaman jurusan untuk pengunjung</p>
                </div>
                <a href="{{ route('jurusan.show', $major) }}" target="_blank"
                    class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                    <x-heroicon-o-eye class="w-4 h-4 mr-2" />
                    Lihat Halaman
                </a>
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('admin.majors.index') }}" 
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-200">
                Batal
            </a>
            <button type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-md text-sm font-bold hover:bg-blue-700">
                Simpan Konten
            </button>
        </div>
    </form>
</div>

@endsection
