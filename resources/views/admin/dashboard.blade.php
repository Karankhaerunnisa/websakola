@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-lg shadow-sm p-6 flex items-center">
        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
            <x-heroicon-o-users class="w-8 h-8" />
        </div>
        <div>
            <div class="text-3xl font-bold text-gray-800">{{ $stats['total'] }}</div>
            <div class="text-sm text-gray-500 font-medium">Total Pendaftar</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 flex items-center">
        <div class="p-3 rounded-full bg-orange-100 text-orange-600 mr-4">
            <x-heroicon-o-clock class="w-8 h-8" />
        </div>
        <div>
            <div class="text-3xl font-bold text-gray-800">{{ $stats['pending'] }}</div>
            <div class="text-sm text-gray-500 font-medium">Menunggu Verifikasi</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 flex items-center">
        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
            <x-heroicon-o-check-circle class="w-8 h-8" />
        </div>
        <div>
            <div class="text-3xl font-bold text-gray-800">{{ $stats['accepted'] }}</div>
            <div class="text-sm text-gray-500 font-medium">Diterima</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 flex items-center">
        <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
            <x-heroicon-o-x-circle class="w-8 h-8" />
        </div>
        <div>
            <div class="text-3xl font-bold text-gray-800">{{ $stats['rejected'] }}</div>
            <div class="text-sm text-gray-500 font-medium">Ditolak</div>
        </div>
    </div>
</div>

<div class="flex flex-wrap gap-4 mb-8">
    <a href="{{ route('admin.registrants.index') }}"
        class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-full font-medium shadow-sm transition-colors">
        <x-heroicon-o-check class="w-5 h-5 mr-2" />
        Verifikasi Pendaftar
    </a>
    <a href="{{ route('admin.registrants.index') }}"
        class="flex items-center bg-white hover:bg-gray-50 text-blue-600 border border-blue-200 px-5 py-2.5 rounded-full font-medium shadow-sm transition-colors">
        <x-heroicon-o-user-group class="w-5 h-5 mr-2" />
        Lihat Semua Pendaftar
    </a>
    <a href="{{ route('admin.pengumuman-ujian.index') }}"
        class="flex items-center bg-white hover:bg-gray-50 text-blue-600 border border-blue-200 px-5 py-2.5 rounded-full font-medium shadow-sm transition-colors">
        <x-heroicon-o-megaphone class="w-5 h-5 mr-2" />
        Kelola Pengumuman
    </a>
</div>

<!-- 3. Bottom Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="p-4 border-b border-gray-100 flex items-center">
            <x-heroicon-o-user-plus class="w-5 h-5 mr-2 text-gray-500" />
            <h3 class="font-bold text-gray-800">Pendaftar Terbaru</h3>
        </div>

        <table class="w-full text-left">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="p-3 text-sm font-semibold">Nama</th>
                    <th class="p-3 text-sm font-semibold">Jurusan</th>
                    <th class="p-3 text-sm font-semibold">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                {{-- Note: Ensure variable matches Controller ($latest_registrants) --}}
                @forelse($latestRegistrants as $reg)
                <tr class="hover:bg-gray-50">
                    <td class="p-3">
                        <div class="font-bold text-gray-800">{{ $reg->name }}</div>
                        <div class="text-xs text-gray-500">{{ $reg->registration_number }}</div>
                    </td>
                    <td class="p-3 text-sm text-gray-600">{{ $reg->major->name }}</td>
                    <td class="p-3">
                        <span
                            class="px-2 py-1 rounded-full text-xs font-bold bg-{{ $reg->status->color() }}-100 text-{{ $reg->status->color() }}-700">
                            {{ $reg->status->label() }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500 text-sm">Belum ada pendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="p-4 border-b border-gray-100 flex items-center">
            <x-heroicon-o-chart-pie class="w-5 h-5 mr-2 text-gray-500" />
            <h3 class="font-bold text-gray-800">Statistik Per Jurusan</h3>
        </div>

        <table class="w-full text-left">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="p-3 text-sm font-semibold">Jurusan</th>
                    <th class="p-3 text-sm font-semibold text-right">Jumlah</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                {{-- Note: Ensure variable matches Controller ($major_stats) --}}
                @foreach($majorStats as $major)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 text-sm text-gray-700">{{ $major->name }}</td>
                    <td class="p-3 text-sm font-bold text-blue-600 text-right">{{ $major->registrants_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
