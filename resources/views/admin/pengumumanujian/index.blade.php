@extends('layouts.admin')

@section('title', 'Kelola Pengumuman Ujian')

@section('content')

<div x-data="{
    modalOpen: false,
    isEdit: false,
    formAction: '',
    formMethod: 'POST',
    modalTitle: '',
    searchQuery: '',

    // Initial Data
    data: { id: '', registrant_id: '', status: 'Lulus' },

    openCreate() {
        this.isEdit = false;
        this.formAction = '{{ route('admin.pengumuman-ujian.store') }}';
        this.formMethod = 'POST';
        this.modalTitle = 'Tambah Pengumuman Ujian';
        this.data = { id: '', registrant_id: '', status: 'Lulus' };
        this.searchQuery = '';
        this.modalOpen = true;
    },

    openEdit(item) {
        this.isEdit = true;
        this.formAction = '{{ url('admin/pengumuman-ujian') }}/' + item.id;
        this.formMethod = 'PUT';
        this.modalTitle = 'Edit Pengumuman Ujian';
        this.data = { 
            id: item.id, 
            registrant_id: item.registrant_id, 
            status: item.status 
        };
        this.searchQuery = '';
        this.modalOpen = true;
    }
}">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-medium text-gray-900">Daftar Pengumuman Ujian</h2>
        <button @click="openCreate()"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition text-sm font-medium flex items-center shadow-sm">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
            Tambah Pengumuman Ujian
        </button>
    </div>

    @if(session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative">{{ session('success') }}</div>
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

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider w-12">No</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">No. Pendaftaran</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">NISN</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Nama Pendaftar</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Jurusan</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-center">Status Kelulusan</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-center">Tanggal Dibuat</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pengumumanujian as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4 text-sm text-gray-500">
                            {{ ($pengumumanujian->currentPage() - 1) * $pengumumanujian->perPage() + $loop->iteration }}
                        </td>

                        <td class="p-4">
                            <span class="font-mono text-sm font-bold text-gray-700">
                                {{ $item->registrant->registration_number ?? '-' }}
                            </span>
                        </td>

                        <td class="p-4">
                            <span class="font-mono text-sm text-gray-600">
                                {{ $item->registrant->nisn ?? '-' }}
                            </span>
                        </td>

                        <td class="p-4">
                            <div class="font-bold text-gray-800">{{ $item->registrant->name ?? '-' }}</div>
                            @if($item->registrant)
                            <div class="text-xs text-gray-500 mt-1 flex items-center">
                                <x-heroicon-o-envelope class="w-3 h-3 mr-1" />
                                {{ $item->registrant->email }}
                            </div>
                            @endif
                        </td>

                        <td class="p-4 text-sm text-gray-600">
                            {{ $item->registrant->major->name ?? '-' }}
                        </td>

                        <td class="p-4 text-center">
                            @if($item->status === 'Lulus')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                <x-heroicon-o-check-circle class="w-4 h-4 mr-1" />
                                Lulus
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                <x-heroicon-o-x-circle class="w-4 h-4 mr-1" />
                                Tidak Lulus
                            </span>
                            @endif
                        </td>

                        <td class="p-4 text-sm text-gray-600 text-center">
                            {{ $item->created_at->format('d/m/Y H:i') }}
                        </td>

                        <td class="p-4 flex justify-center gap-2">
                            <button @click="openEdit({
                                id: {{ $item->id }},
                                registrant_id: {{ $item->registrant_id }},
                                status: '{{ $item->status }}'
                            })"
                                class="p-2 bg-yellow-50 text-yellow-600 rounded-full hover:bg-yellow-100 transition"
                                title="Edit">
                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                            </button>
                            <form action="{{ route('admin.pengumuman-ujian.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Hapus pengumuman ujian ini?');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="p-2 bg-red-50 text-red-600 rounded-full hover:bg-red-100 transition"
                                    title="Hapus">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-8 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <x-heroicon-o-inbox class="w-12 h-12 text-gray-300 mb-3" />
                                <p>Belum ada pengumuman ujian.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $pengumumanujian->links() }}
        </div>
    </div>

    {{-- Modal Form --}}
    <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="modalOpen = false"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900" x-text="modalTitle"></h3>
                    <button @click="modalOpen = false">
                        <x-heroicon-o-x-mark class="h-6 w-6 text-gray-400 hover:text-gray-600" />
                    </button>
                </div>

                <form :action="formAction" method="POST">
                    @csrf
                    <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Pendaftar</label>
                        <div class="relative">
                            <input type="text" 
                                x-model="searchQuery"
                                placeholder="Cari nama atau no. pendaftaran..."
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm mb-2">
                        </div>
                        <select name="registrant_id" x-model="data.registrant_id" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            size="6">
                            <option value="">-- Pilih Pendaftar --</option>
                            @foreach($registrants as $registrant)
                            <option value="{{ $registrant->id }}" 
                                x-show="!searchQuery || '{{ strtolower($registrant->name . ' ' . $registrant->registration_number) }}'.includes(searchQuery.toLowerCase())">
                                {{ $registrant->registration_number }} - {{ $registrant->name }}
                            </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Pilih pendaftar dari daftar di atas</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Kelulusan</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 px-4 py-3 border rounded-lg cursor-pointer transition-all"
                                :class="data.status === 'Lulus' ? 'border-green-500 bg-green-50 ring-2 ring-green-500' : 'border-gray-200 hover:border-gray-300'">
                                <input type="radio" name="status" value="Lulus" x-model="data.status" class="hidden">
                                <x-heroicon-o-check-circle class="w-5 h-5 text-green-600" />
                                <span class="font-medium text-green-700">Lulus</span>
                            </label>
                            <label class="flex items-center gap-2 px-4 py-3 border rounded-lg cursor-pointer transition-all"
                                :class="data.status === 'Tidak Lulus' ? 'border-red-500 bg-red-50 ring-2 ring-red-500' : 'border-gray-200 hover:border-gray-300'">
                                <input type="radio" name="status" value="Tidak Lulus" x-model="data.status" class="hidden">
                                <x-heroicon-o-x-circle class="w-5 h-5 text-red-600" />
                                <span class="font-medium text-red-700">Tidak Lulus</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4 border-t">
                        <button type="button" @click="modalOpen = false"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-200 transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-bold hover:bg-blue-700 transition">
                            <x-heroicon-o-check class="w-4 h-4 inline mr-1" />
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection
