@extends('layouts.admin')

@section('title', 'Kelola Jurusan')

@section('content')

<div x-data="{
    modalOpen: false,
    isEdit: false,
    formAction: '{{ route('admin.majors.store') }}',
    formMethod: 'POST',
    modalTitle: 'Tambah Jurusan',

    // Form Data
    data: { id: '', code: '', name: '', quota: '', description: '' },

    openCreate() {
        this.isEdit = false;
        this.formAction = '{{ route('admin.majors.store') }}';
        this.formMethod = 'POST';
        this.modalTitle = 'Tambah Jurusan Baru';
        this.data = { id: '', code: '', name: '', quota: '', description: '' };
        this.modalOpen = true;
    },

    openEdit(major) {
        this.isEdit = true;
        // Construct the Update URL: /admin/majors/{code}
        this.formAction = '{{ url('admin/majors') }}/' + major.code;
        this.formMethod = 'PUT'; // Laravel handles PUT via _method field
        this.modalTitle = 'Edit Jurusan';
        this.data = major; // Fill form with row data
        this.modalOpen = true;
    }
}">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-medium text-gray-900">Daftar Jurusan</h2>

        <button @click="openCreate()"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors text-sm font-medium flex items-center shadow-sm">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
            Tambah Jurusan
        </button>
    </div>

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

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider w-16">Kode</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Nama Jurusan</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Terisi / Kuota</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($majors as $major)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4">
                            <span class="font-mono text-sm font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">
                                {{ $major->code }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-gray-800">{{ $major->name }}</div>
                            <div class="text-xs text-gray-500 truncate max-w-xs">{{ $major->description }}</div>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center">
                                <div class="w-24 bg-gray-200 rounded-full h-2.5 mr-2">
                                    @php $percent = $major->quota > 0 ? ($major->registrants_count / $major->quota) * 100 : 0; @endphp
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ min($percent, 100) }}%"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-700">
                                    {{ $major->registrants_count }} / {{ $major->quota }}
                                </span>
                            </div>
                        </td>
                        <td class="p-4 flex justify-center gap-2">
                            <a href="{{ route('admin.majors.edit-content', $major->code) }}"
                                    class="p-2 bg-green-50 text-green-600 rounded-full hover:bg-green-100 transition" title="Edit Konten">
                                <x-heroicon-o-document-text class="w-4 h-4" />
                            </a>
                            <button @click="openEdit({{ $major }})"
                                    class="p-2 bg-yellow-50 text-yellow-600 rounded-full hover:bg-yellow-100 transition" title="Edit Info">
                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                            </button>

                            <form action="{{ route('admin.majors.destroy', $major->code) }}" method="POST"
                                  onsubmit="return confirm('Hapus jurusan {{ $major->code }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-full hover:bg-red-100 transition" title="Hapus">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500">Belum ada jurusan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

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

                <form :action="formAction" method="POST">
                    @csrf
                    <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Jurusan</label>
                            <input type="text" name="code" x-model="data.code" required maxlength="10"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm uppercase"
                                   placeholder="RPL">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kuota</label>
                            <input type="number" name="quota" x-model="data.quota" required min="0"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jurusan</label>
                        <input type="text" name="name" x-model="data.name" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                               placeholder="Rekayasa Perangkat Lunak">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (Opsional)</label>
                        <textarea name="description" x-model="data.description" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"></textarea>
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
