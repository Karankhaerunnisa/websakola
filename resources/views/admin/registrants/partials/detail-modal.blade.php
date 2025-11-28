<div class="flex flex-col lg:flex-row gap-6">

    <div class="flex-1 space-y-4">
        <div class="border-b pb-2">
            <h3 class="text-lg font-bold text-gray-800">{{ $registrant->name }}</h3>
            <p class="text-sm text-gray-500">{{ $registrant->registration_number }}</p>
        </div>

        <div class="grid grid-cols-2 gap-y-3 text-sm">
            <div class="text-gray-500">NISN / NIK</div>
            <div class="font-medium text-gray-800">{{ $registrant->nisn ?? '-' }} / {{ $registrant->nik ?? '-' }}</div>

            <div class="text-gray-500">TTL</div>
            <div class="font-medium text-gray-800">{{ $registrant->birth_place }}, {{
                $registrant->birth_date->format('d-m-Y') }}</div>

            <div class="text-gray-500">Jenis Kelamin</div>
            <div class="font-medium text-gray-800">{{ $registrant->gender->label() }}</div>

            <div class="text-gray-500">Jurusan</div>
            <div class="font-medium text-gray-800">{{ $registrant->major->name }}</div>

            <div class="text-gray-500">Asal Sekolah</div>
            <div class="font-medium text-gray-800">{{ $registrant->academic->school_name ?? '-' }}</div>

            <div class="text-gray-500">Rata-rata Nilai</div>
            <div class="font-medium text-gray-800">{{ $registrant->academic->average_score ?? '0' }}</div>

            <div class="text-gray-500">Alamat</div>
            <div class="font-medium text-gray-800 col-span-2">{{ $registrant->address?->full_address ?? '-' }}</div>
        </div>

        <div class="mt-4 pt-4 border-t">
            <h4 class="font-bold text-sm text-gray-800 mb-2">Data Orang Tua / Wali</h4>
            @foreach($registrant->guardians as $guardian)
            <div class="text-sm text-gray-600 mb-1">
                <span class="font-medium">{{ $guardian->relationship->label() }}:</span>
                {{ $guardian->name }} ({{ $guardian->phone }})
                @if($guardian->whatsapp_url)
                <a href="{{ $guardian->whatsapp_url }}" target="_blank"
                    class="inline-flex items-center justify-center w-8 h-8 bg-green-50 text-green-600 rounded-full hover:bg-green-600 hover:text-white transition-all shadow-sm"
                    title="Chat Orang Tua (WhatsApp)">
                    <x-heroicon-o-chat-bubble-oval-left-ellipsis class="w-4 h-4" />
                </a>
                @else
                <span
                    class="inline-flex items-center justify-center w-8 h-8 bg-gray-50 text-gray-300 rounded-full cursor-not-allowed">
                    <x-heroicon-o-chat-bubble-oval-left-ellipsis class="w-4 h-4" />
                </span>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    <div class="w-full lg:w-1/3 bg-gray-50 p-4 rounded-lg border border-gray-200">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <x-heroicon-o-pencil-square class="w-4 h-4 mr-2" />
            Verifikasi Data
        </h4>

        <form action="{{ route('admin.registrants.update', $registrant->registration_number) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Status Pendaftaran</label>
                <select name="status"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @foreach(\App\Enums\RegistrantStatus::cases() as $status)
                    <option value="{{ $status->value }}" {{ $registrant->status === $status ? 'selected' : '' }}>
                        {{ $status->label() }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Catatan Admin</label>
                <textarea name="admin_note" rows="4"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                    placeholder="Contoh: Dokumen KK kurang jelas...">{{ $registrant->admin_note ?? ''}}</textarea>
            </div>

            <div class="space-y-2 mb-2">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md text-sm font-bold hover:bg-blue-700 transition">
                    Simpan Perubahan
                </button>

                <a href="{{ route('admin.registrants.print', $registrant->registration_number) }}" target="_blank"
                    class="w-full block text-center bg-white border border-gray-300 text-gray-700 py-2 rounded-md text-sm font-bold hover:bg-gray-50 transition">
                    <x-heroicon-o-printer class="w-4 h-4 inline mr-1" /> Cetak Bukti
                </a>

            </div>
        </form>
        <div class="mb-2">
            <form action="{{ route('admin.registrants.destroy', $registrant->registration_number) }}" method="POST"
                class="w-full">
                @csrf
                @method('DELETE')


                <button type="submit"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini? Tindakan ini tidak bisa dibatalkan.')"
                    class="w-full bg-red-50 text-red-600 border border-red-200 py-2 rounded-md text-sm font-bold hover:bg-red-100 transition flex items-center justify-center">
                    <x-heroicon-o-trash class="w-4 h-4 mr-2" /> Hapus Data
                </button>
            </form>
        </div>
    </div>
</div>
