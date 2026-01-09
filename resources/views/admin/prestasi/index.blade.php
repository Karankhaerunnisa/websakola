@extends('layouts.admin')

@section('title', 'Kelola Prestasi')

@section('content')

<div x-data="{
    modalOpen: false,
    isEdit: false,
    formAction: '{{ route('admin.prestasi.store') }}',
    modalTitle: 'Tambah Prestasi',
    data: { id: '', title: '', category: '', level: '', rank: '', student_name: '', event_name: '', achievement_date: '', description: '', is_active: true },

    openCreate() {
        this.isEdit = false;
        this.formAction = '{{ route('admin.prestasi.store') }}';
        this.modalTitle = 'Tambah Prestasi Baru';
        this.data = { id: '', title: '', category: '', level: '', rank: '', student_name: '', event_name: '', achievement_date: '', description: '', is_active: true };
        this.modalOpen = true;
    },

    openEdit(item) {
        this.isEdit = true;
        this.formAction = '{{ url('admin/prestasi') }}/' + item.id;
        this.modalTitle = 'Edit Prestasi';
        this.data = {...item, is_active: item.is_active == 1, achievement_date: item.achievement_date ? item.achievement_date.split('T')[0] : ''};
        this.modalOpen = true;
    }
}">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-medium text-gray-900">Daftar Prestasi</h2>
        <button @click="openCreate()"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors text-sm font-medium flex items-center shadow-sm">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
            Tambah Prestasi
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Foto</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Judul</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Kategori</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Level</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Peringkat</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Status</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($prestasi as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4">
                            @if($item->photo)
                            <img src="{{ asset('storage/prestasi/' . $item->photo) }}" class="w-16 h-12 rounded object-cover">
                            @else
                            <div class="w-16 h-12 rounded bg-gray-200 flex items-center justify-center">
                                <x-heroicon-o-trophy class="w-6 h-6 text-gray-400" />
                            </div>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="font-medium text-gray-900">{{ $item->title }}</div>
                            <div class="text-xs text-gray-500">{{ $item->student_name ?? '' }}</div>
                        </td>
                        <td class="p-4">
                            <span class="bg-purple-100 text-purple-700 text-xs font-medium px-2 py-1 rounded">{{ $categories[$item->category] ?? $item->category }}</span>
                        </td>
                        <td class="p-4">
                            <span class="bg-blue-100 text-blue-700 text-xs font-medium px-2 py-1 rounded">{{ $levels[$item->level] ?? $item->level }}</span>
                        </td>
                        <td class="p-4">
                            <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded">{{ $item->rank ?? '-' }}</span>
                        </td>
                        <td class="p-4">
                            @if($item->is_active)
                            <span class="bg-green-100 text-green-700 text-xs font-medium px-2 py-1 rounded">Aktif</span>
                            @else
                            <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2 py-1 rounded">Nonaktif</span>
                            @endif
                        </td>
                        <td class="p-4 flex justify-center gap-2">
                            <button @click="openEdit({{ $item }})"
                                    class="p-2 bg-yellow-50 text-yellow-600 rounded-full hover:bg-yellow-100 transition">
                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                            </button>
                            <form action="{{ route('admin.prestasi.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus prestasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-full hover:bg-red-100 transition">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-500">Belum ada data prestasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="modalOpen = false"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900" x-text="modalTitle"></h3>
                    <button @click="modalOpen = false" class="text-gray-400 hover:text-gray-500">
                        <x-heroicon-o-x-mark class="h-6 w-6" />
                    </button>
                </div>

                <form :action="formAction" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Prestasi *</label>
                        <input type="text" name="title" x-model="data.title" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                            <select name="category" x-model="data.category" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Level *</label>
                            <select name="level" x-model="data.level" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="">Pilih Level</option>
                                @foreach($levels as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Peringkat</label>
                            <input type="text" name="rank" x-model="data.rank"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                   placeholder="Juara 1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                            <input type="date" name="achievement_date" x-model="data.achievement_date"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                            <input type="text" name="student_name" x-model="data.student_name"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Event</label>
                            <input type="text" name="event_name" x-model="data.event_name"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                        <input type="file" name="photo" accept="image/*"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" x-model="data.description" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" x-model="data.is_active"
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Tampilkan di Halaman Publik</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="modalOpen = false" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-bold hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
