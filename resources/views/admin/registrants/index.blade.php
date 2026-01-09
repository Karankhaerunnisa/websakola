@extends('layouts.admin')

@section('title', 'Data Pendaftar')

@section('content')

<div x-data="{
    modalOpen: false,
    modalContent: 'Loading...',
    openModal(url) {
        this.modalOpen = true;
        this.modalContent = '<div class=\'p-4 text-center\'><svg class=\'animate-spin h-8 w-8 text-blue-500 mx-auto\' xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 24 24\'><circle class=\'opacity-25\' cx=\'12\' cy=\'12\' r=\'10\' stroke=\'currentColor\' stroke-width=\'4\'></circle><path class=\'opacity-75\' fill=\'currentColor\' d=\'M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z\'></path></svg></div>';

        fetch(url)
            .then(response => response.text())
            .then(html => {
                this.modalContent = html;
            })
            .catch(err => {
                this.modalContent = '<p class=\'text-red-500 p-4\'>Gagal memuat data.</p>';
            });
    }
}">

    @if(session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
    @if(session('error'))
    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif
    @if ($errors->any())
    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-6">
        <form method="GET" action="{{ route('admin.registrants.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">Semua Status</option>
                        @foreach($statuses as $status)
                        <option value="{{ $status->value }}" {{ request('status')==$status->value ? 'selected' : '' }}>
                            {{ $status->label() }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                    <select name="majorCode"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">Semua Jurusan</option>
                        @foreach($majors as $major)
                        <option value="{{ $major->code }}" {{ request('majorCode')==$major->code ? 'selected' : '' }}>
                            {{ $major->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama/No.Daftar/NISN</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Nama / No. Pendaftaran / NISN"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Asal Sekolah</label>
                    <input type="text" name="schoolSearch" value="{{ request('schoolSearch') }}"
                        placeholder="Nama Sekolah..."
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div class="md:col-span-1">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors text-sm font-medium h-[38px] flex items-center justify-center">
                        <x-heroicon-o-magnifying-glass class="w-4 h-4" />
                    </button>
                </div>

            </div>
        </form>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.registrants.export', request()->query()) }}"
                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors text-sm font-medium flex items-center shadow-sm">
                <x-heroicon-o-document-arrow-down class="w-4 h-4 mr-2" />
                Export ke Excel
            </a>

            <span class="text-sm text-gray-600 font-medium flex items-center">
                <x-heroicon-o-users class="w-4 h-4 mr-2 text-gray-400" />
                Total: {{ $registrants->total() }} pendaftar
            </span>
        </div>

    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider w-12">No</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">No. Pendaftaran</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Nama</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Jurusan</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Asal Sekolah</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Kontak</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Jalur Pendaftar</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-center">Status</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($registrants as $index => $reg)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4 text-sm text-gray-500">
                            {{ ($registrants->currentPage() - 1) * $registrants->perPage() + $loop->iteration }}
                        </td>

                        <td class="p-4">
                            <span class="font-mono text-sm font-bold text-gray-700">
                                {{ $reg->registration_number }}
                            </span>
                        </td>

                        <td class="p-4">
                            <div class="font-bold text-gray-800">{{ $reg->name }}</div>
                            <div class="text-xs text-gray-500 mt-1 flex items-center">
                                <x-heroicon-o-map-pin class="w-3 h-3 mr-1" />
                                {{ $reg->birth_place }}, {{ $reg->birth_date->format('d-m-Y') }}
                            </div>
                        </td>

                        <td class="p-4 text-sm text-gray-600">
                            {{ $reg->major->name }}
                        </td>

                        <td class="p-4 text-sm text-gray-600">
                            {{ $reg->academic->school_name}}
                        </td>

                        <td class="p-4 text-sm">
                            <div class="flex items-center text-gray-600 mb-1">
                                <a href="{{ $reg->whatsapp_url }}" target="_blank"
                                    class="hover:text-green-600 hover:underline transition-colors flex items-center gap-1"
                                    title="Chat WhatsApp">
                                    <x-heroicon-o-chat-bubble-oval-left-ellipsis class="w-3 h-3 mr-2" />
                                </a>
                                {{ $reg->phone ?? '-' }}
                            </div>
                            <div class="flex items-center text-gray-600">
                                <x-heroicon-o-envelope class="w-3 h-3 mr-2" />
                                {{ $reg->email }}
                            </div>
                        </td>

                        <td class="p-4 text-sm">
                            @if($reg->registration_path == 'umum' || $reg->registration_path == '1')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                    Jalur Umum
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                    Jalur Prestasi
                                </span>
                            @endif
                        </td>

                        <td class="p-4 text-sm text-gray-600">
                            {{ $reg->created_at->format('d/m/Y H:i') }}
                        </td>

                        <td class="p-4 text-center">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $reg->status->color() }}-100 text-{{ $reg->status->color() }}-700">
                                {{ $reg->status->label() }}
                            </span>
                        </td>

                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center gap-2">

                                @if($reg->whatsapp_url)
                                <a href="{{ $reg->whatsapp_url }}" target="_blank"
                                    class="inline-flex items-center justify-center w-8 h-8 bg-green-50 text-green-600 rounded-full hover:bg-green-600 hover:text-white transition-all shadow-sm"
                                    title="Chat WhatsApp">
                                    <x-heroicon-o-chat-bubble-oval-left-ellipsis class="w-4 h-4" />
                                </a>
                                @else
                                <span
                                    class="inline-flex items-center justify-center w-8 h-8 bg-gray-50 text-gray-300 rounded-full cursor-not-allowed">
                                    <x-heroicon-o-chat-bubble-oval-left-ellipsis class="w-4 h-4" />
                                </span>
                                @endif
                                <button
                                    @click="openModal('{{ route('admin.registrants.show', $reg->registration_number) }}')"
                                    class="inline-flex items-center justify-center w-8 h-8 bg-blue-50 text-blue-600 rounded-full hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                    <x-heroicon-o-eye class="w-4 h-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="p-8 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <x-heroicon-o-inbox class="w-12 h-12 text-gray-300 mb-3" />
                                <p>Tidak ada data pendaftar yang ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $registrants->withQueryString()->links() }}
        </div>
    </div>

    <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div x-show="modalOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="modalOpen = false"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div x-show="modalOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">

                <div class="absolute right-0 top-0 pr-4 pt-4 z-10">
                    <button @click="modalOpen = false" type="button"
                        class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <x-heroicon-o-x-mark class="h-6 w-6" />
                    </button>
                </div>

                <div class="p-6" x-html="modalContent"></div>
            </div>
        </div>
    </div>
</div>

@endsection
