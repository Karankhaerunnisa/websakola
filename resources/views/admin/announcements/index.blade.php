@extends('layouts.admin')

@section('title', 'Kelola Informasi')

@section('content')

<div x-data="{
    modalOpen: false,
    isEdit: false,
    formAction: '',
    formMethod: 'POST',
    modalTitle: '',

    // Initial Data
    data: { id: '', title: '', content: '', published_at: '', expired_at: '', is_active: false },

    openCreate() {
        this.isEdit = false;
        this.formAction = '{{ route('admin.announcements.store') }}';
        this.formMethod = 'POST';
        this.modalTitle = 'Buat Informasi atau Berita Baru';
        // Set default date to Today
        const today = new Date().toISOString().slice(0, 16);
        this.data = { id: '', title: '', content: '', published_at: today, expired_at: '', is_active: true };
        this.modalOpen = true;
    },

    openEdit(item) {
        this.isEdit = true;
        this.formAction = '{{ url('admin/announcements') }}/' + item.id;
        this.formMethod = 'PUT';
        this.modalTitle = 'Edit Informasi';

        // Format dates for HTML datetime-local input (YYYY-MM-DDTHH:MM)
        let pub = item.published_at ? item.published_at.slice(0, 16) : '';
        let exp = item.expired_at ? item.expired_at.slice(0, 16) : '';

        this.data = { ...item, published_at: pub, expired_at: exp };
        this.modalOpen = true;
    }
}">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-medium text-gray-900">Daftar Informasi</h2>
        <button @click="openCreate()"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition text-sm font-medium flex items-center shadow-sm">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
            Buat Informasi
        </button>
    </div>

    @if(session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative">{{
        session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Judul</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Masa Tayang</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-center">Status</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($announcements as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4">
                            <div class="font-bold text-gray-800">{{ $item->title }}</div>
                            <div class="text-xs text-gray-500 truncate max-w-xs">{{ Str::limit($item->content, 50) }}
                            </div>
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                            <div class="flex flex-col text-xs">
                                <span>Mulai: {{ $item->published_at ? $item->published_at->format('d M Y H:i') : '-'
                                    }}</span>
                                <span class="text-gray-400">Selesai: {{ $item->expired_at ? $item->expired_at->format('d
                                    M Y H:i') : 'Selamanya' }}</span>
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            @if($item->is_active)
                            <span
                                class="px-2 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Aktif</span>
                            @else
                            <span
                                class="px-2 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600">Non-Aktif</span>
                            @endif
                        </td>
                        <td class="p-4 flex justify-center gap-2">
                            <button @click="openEdit({{ $item }})"
                                class="p-2 bg-yellow-50 text-yellow-600 rounded-full hover:bg-yellow-100 transition">
                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                            </button>
                            <form action="{{ route('admin.announcements.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Hapus informasi ini?');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="p-2 bg-red-50 text-red-600 rounded-full hover:bg-red-100 transition">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500">Belum ada informasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="modalOpen = false"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-2xl p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900" x-text="modalTitle"></h3>
                    <button @click="modalOpen = false">
                        <x-heroicon-o-x-mark class="h-6 w-6 text-gray-400" />
                    </button>
                </div>

                <form :action="formAction" method="POST">
                    @csrf
                    <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Informasi</label>
                        <input type="text" name="title" x-model="data.title" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 text-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai Tayang</label>
                            <input type="datetime-local" name="published_at" x-model="data.published_at"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai
                                (Opsional)</label>
                            <input type="datetime-local" name="expired_at" x-model="data.expired_at"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 text-sm">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika berlaku selamanya</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Isi Informasi</label>
                        <textarea name="content" x-model="data.content" rows="6" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 text-sm"></textarea>
                    </div>

                    <div class="mb-6 flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" x-model="data.is_active"
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">Publikasikan (Aktif)</label>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="modalOpen = false"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm hover:bg-gray-200">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-bold hover:bg-blue-700">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection
