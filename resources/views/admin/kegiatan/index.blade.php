@extends('layouts.admin')

@section('title', 'Kelola Kegiatan')

@section('content')

<div x-data="{
    modalOpen: false,
    isEdit: false,
    formAction: '{{ route('admin.kegiatan.store') }}',
    modalTitle: 'Tambah Kegiatan',
    data: { id: '', title: '', category: '', event_date: '', location: '', description: '', is_active: true },

    openCreate() {
        this.isEdit = false;
        this.formAction = '{{ route('admin.kegiatan.store') }}';
        this.modalTitle = 'Tambah Kegiatan Baru';
        this.data = { id: '', title: '', category: '', event_date: '', location: '', description: '', is_active: true };
        this.modalOpen = true;
    },

    openEdit(item) {
        this.isEdit = true;
        this.formAction = '{{ url('admin/kegiatan') }}/' + item.id;
        this.modalTitle = 'Edit Kegiatan';
        this.data = {...item, is_active: item.is_active == 1, event_date: item.event_date ? item.event_date.split('T')[0] : ''};
        this.modalOpen = true;
    }
}">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-medium text-gray-900">Daftar Kegiatan</h2>
        <button @click="openCreate()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium flex items-center">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />Tambah Kegiatan
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($kegiatan as $item)
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden hover:shadow-md transition">
            @if($item->photo)
            <img src="{{ asset('storage/kegiatan/' . $item->photo) }}" class="w-full h-40 object-cover">
            @else
            <div class="w-full h-40 bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                <x-heroicon-o-calendar-days class="w-16 h-16 text-white/50" />
            </div>
            @endif
            <div class="p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="bg-blue-100 text-blue-700 text-xs font-medium px-2 py-1 rounded">{{ $categories[$item->category] ?? $item->category }}</span>
                    <span class="{{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }} text-xs px-2 py-1 rounded">{{ $item->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">{{ $item->title }}</h3>
                @if($item->event_date)<div class="flex items-center text-sm text-gray-500 mb-1"><x-heroicon-o-calendar class="w-4 h-4 mr-1" />{{ $item->event_date->format('d M Y') }}</div>@endif
                @if($item->location)<div class="flex items-center text-sm text-gray-500 mb-3"><x-heroicon-o-map-pin class="w-4 h-4 mr-1" />{{ $item->location }}</div>@endif
                <div class="flex justify-end gap-2 pt-3 border-t">
                    <button @click="openEdit({{ $item }})" class="p-2 bg-yellow-50 text-yellow-600 rounded-full hover:bg-yellow-100"><x-heroicon-o-pencil-square class="w-4 h-4" /></button>
                    <form action="{{ route('admin.kegiatan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus?');">@csrf @method('DELETE')<button type="submit" class="p-2 bg-red-50 text-red-600 rounded-full hover:bg-red-100"><x-heroicon-o-trash class="w-4 h-4" /></button></form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-500">Belum ada data kegiatan.</div>
        @endforelse
    </div>

    <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="modalOpen = false"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold" x-text="modalTitle"></h3>
                    <button @click="modalOpen = false" class="text-gray-400 hover:text-gray-500"><x-heroicon-o-x-mark class="h-6 w-6" /></button>
                </div>
                <form :action="formAction" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">
                    <div class="mb-4"><label class="block text-sm font-medium mb-1">Judul *</label><input type="text" name="title" x-model="data.title" required class="w-full rounded-md border-gray-300 text-sm"></div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div><label class="block text-sm font-medium mb-1">Kategori *</label><select name="category" x-model="data.category" required class="w-full rounded-md border-gray-300 text-sm"><option value="">Pilih</option>@foreach($categories as $key => $label)<option value="{{ $key }}">{{ $label }}</option>@endforeach</select></div>
                        <div><label class="block text-sm font-medium mb-1">Tanggal</label><input type="date" name="event_date" x-model="data.event_date" class="w-full rounded-md border-gray-300 text-sm"></div>
                    </div>
                    <div class="mb-4"><label class="block text-sm font-medium mb-1">Lokasi</label><input type="text" name="location" x-model="data.location" class="w-full rounded-md border-gray-300 text-sm"></div>
                    <div class="mb-4"><label class="block text-sm font-medium mb-1">Foto</label><input type="file" name="photo" accept="image/*" class="w-full text-sm"></div>
                    <div class="mb-4"><label class="block text-sm font-medium mb-1">Deskripsi</label><textarea name="description" x-model="data.description" rows="3" class="w-full rounded-md border-gray-300 text-sm"></textarea></div>
                    <div class="mb-6"><label class="flex items-center"><input type="checkbox" name="is_active" x-model="data.is_active" class="rounded border-gray-300 text-blue-600"><span class="ml-2 text-sm">Tampilkan</span></label></div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="modalOpen = false" class="px-4 py-2 bg-gray-100 rounded-md text-sm">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-bold">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
