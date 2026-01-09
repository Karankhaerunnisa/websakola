@extends('layouts.admin')

@section('title', 'Kelola Ekstrakurikuler')

@section('content')

<div x-data="{
    modalOpen: false,
    isEdit: false,
    formAction: '{{ route('admin.ekskul.store') }}',
    modalTitle: 'Tambah Ekstrakurikuler',
    data: { id: '', name: '', category: '', schedule: '', instructor: '', description: '', is_active: true },

    openCreate() {
        this.isEdit = false;
        this.formAction = '{{ route('admin.ekskul.store') }}';
        this.modalTitle = 'Tambah Ekstrakurikuler Baru';
        this.data = { id: '', name: '', category: '', schedule: '', instructor: '', description: '', is_active: true };
        this.modalOpen = true;
    },

    openEdit(item) {
        this.isEdit = true;
        this.formAction = '{{ url('admin/ekskul') }}/' + item.id;
        this.modalTitle = 'Edit Ekstrakurikuler';
        this.data = {...item, is_active: item.is_active == 1};
        this.modalOpen = true;
    }
}">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-medium text-gray-900">Daftar Ekstrakurikuler</h2>
        <button @click="openCreate()"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors text-sm font-medium flex items-center shadow-sm">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
            Tambah Ekskul
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($ekskul as $item)
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
            @if($item->photo)
            <img src="{{ asset('storage/ekskul/' . $item->photo) }}" class="w-full h-40 object-cover">
            @else
            <div class="w-full h-40 bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                <x-heroicon-o-academic-cap class="w-16 h-16 text-white/50" />
            </div>
            @endif
            
            <div class="p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="bg-{{ $item->category == 'olahraga' ? 'green' : ($item->category == 'seni' ? 'purple' : 'blue') }}-100 text-{{ $item->category == 'olahraga' ? 'green' : ($item->category == 'seni' ? 'purple' : 'blue') }}-700 text-xs font-medium px-2 py-1 rounded">
                        {{ $categories[$item->category] ?? $item->category }}
                    </span>
                    @if($item->is_active)
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded">Aktif</span>
                    @else
                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">Nonaktif</span>
                    @endif
                </div>
                
                <h3 class="font-bold text-gray-900 mb-2">{{ $item->name }}</h3>
                
                @if($item->schedule)
                <div class="flex items-center text-sm text-gray-500 mb-1">
                    <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                    {{ $item->schedule }}
                </div>
                @endif
                
                @if($item->instructor)
                <div class="flex items-center text-sm text-gray-500 mb-3">
                    <x-heroicon-o-user class="w-4 h-4 mr-1" />
                    {{ $item->instructor }}
                </div>
                @endif
                
                <div class="flex justify-end gap-2 pt-3 border-t border-gray-100">
                    <button @click="openEdit({{ $item }})"
                            class="p-2 bg-yellow-50 text-yellow-600 rounded-full hover:bg-yellow-100 transition">
                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                    </button>
                    <form action="{{ route('admin.ekskul.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Hapus ekskul ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-full hover:bg-red-100 transition">
                            <x-heroicon-o-trash class="w-4 h-4" />
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-500">
            <x-heroicon-o-academic-cap class="w-12 h-12 mx-auto mb-4 text-gray-300" />
            Belum ada data ekstrakurikuler.
        </div>
        @endforelse
    </div>

    <!-- Modal -->
    <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="modalOpen = false"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-lg p-6">
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ekskul *</label>
                        <input type="text" name="name" x-model="data.name" required
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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jadwal</label>
                            <input type="text" name="schedule" x-model="data.schedule"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                   placeholder="Senin, 15:00-17:00">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pembina/Pelatih</label>
                        <input type="text" name="instructor" x-model="data.instructor"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
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
