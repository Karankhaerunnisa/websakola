@extends('layouts.admin')

@section('title', 'Kelola Alumni')

@section('content')

<div x-data="{
    modalOpen: false,
    isEdit: false,
    formAction: '{{ route('admin.alumni.store') }}',
    modalTitle: 'Tambah Alumni',
    data: { id: '', name: '', graduation_year: '', major: '', current_position: '', company: '', testimonial: '', is_active: true },

    openCreate() {
        this.isEdit = false;
        this.formAction = '{{ route('admin.alumni.store') }}';
        this.modalTitle = 'Tambah Alumni Baru';
        this.data = { id: '', name: '', graduation_year: '', major: '', current_position: '', company: '', testimonial: '', is_active: true };
        this.modalOpen = true;
    },

    openEdit(item) {
        this.isEdit = true;
        this.formAction = '{{ url('admin/alumni') }}/' + item.id;
        this.modalTitle = 'Edit Alumni';
        this.data = {...item, is_active: item.is_active == 1};
        this.modalOpen = true;
    }
}">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-medium text-gray-900">Daftar Alumni</h2>
        <button @click="openCreate()"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors text-sm font-medium flex items-center shadow-sm">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
            Tambah Alumni
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Foto</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Nama</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Tahun Lulus</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Jurusan</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Posisi/Perusahaan</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider">Status</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($alumni as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4">
                            @if($item->photo)
                            <img src="{{ asset('storage/alumni/' . $item->photo) }}" class="w-12 h-12 rounded-full object-cover">
                            @else
                            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                <x-heroicon-o-user class="w-6 h-6 text-gray-400" />
                            </div>
                            @endif
                        </td>
                        <td class="p-4 font-medium text-gray-900">{{ $item->name }}</td>
                        <td class="p-4">
                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-1 rounded">{{ $item->graduation_year }}</span>
                        </td>
                        <td class="p-4 text-gray-600">{{ $item->major ?? '-' }}</td>
                        <td class="p-4">
                            <div class="text-sm text-gray-900">{{ $item->current_position ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $item->company ?? '' }}</div>
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
                            <form action="{{ route('admin.alumni.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus alumni {{ $item->name }}?');">
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
                        <td colspan="7" class="p-8 text-center text-gray-500">Belum ada data alumni.</td>
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

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama *</label>
                            <input type="text" name="name" x-model="data.name" required
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Lulus *</label>
                            <input type="text" name="graduation_year" x-model="data.graduation_year" required maxlength="4"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                   placeholder="2024">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                        <select name="major" x-model="data.major"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach($majors as $major)
                            <option value="{{ $major->name }}">{{ $major->code }} - {{ $major->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Posisi Saat Ini</label>
                            <input type="text" name="current_position" x-model="data.current_position"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                   placeholder="Software Engineer">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Perusahaan</label>
                            <input type="text" name="company" x-model="data.company"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                   placeholder="PT. Example">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                        <input type="file" name="photo" accept="image/*"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Testimoni</label>
                        <textarea name="testimonial" x-model="data.testimonial" rows="3"
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
