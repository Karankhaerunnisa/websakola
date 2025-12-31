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

        {{-- Section Dokumen Pendaftaran --}}
        @if($registrant->documents->count() > 0)
        <div class="mt-4 pt-4 border-t">
            <h4 class="font-bold text-sm text-gray-800 mb-3 flex items-center">
                <x-heroicon-o-document-text class="w-4 h-4 mr-2" />
                Dokumen Pendaftaran
            </h4>
            <div class="grid grid-cols-2 gap-2">
                @foreach($registrant->documents as $document)
                @php
                    $docLabels = [
                        'kartu_keluarga' => 'Kartu Keluarga',
                        'akta_kelahiran' => 'Akta Kelahiran',
                        'pas_foto' => 'Pas Foto',
                        'ijazah_skl' => 'Ijazah/SKL',
                    ];
                    $isPdf = str_ends_with(strtolower($document->file_path), '.pdf');
                @endphp
                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                    class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg border border-gray-200 hover:bg-blue-50 hover:border-blue-300 transition group">
                    @if($isPdf)
                    <div class="w-8 h-8 bg-red-100 text-red-600 rounded flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition">
                        <x-heroicon-o-document class="w-4 h-4" />
                    </div>
                    @else
                    <div class="w-8 h-8 bg-green-100 text-green-600 rounded flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition">
                        <x-heroicon-o-photo class="w-4 h-4" />
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <div class="text-xs font-semibold text-gray-700 truncate">{{ $docLabels[$document->document_type] ?? $document->document_type }}</div>
                        <div class="text-xs text-gray-400 truncate">{{ $document->file_name }}</div>
                    </div>
                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4 text-gray-400 group-hover:text-blue-600" />
                </a>
                @endforeach
            </div>
        </div>
        @else
        <div class="mt-4 pt-4 border-t">
            <h4 class="font-bold text-sm text-gray-800 mb-2 flex items-center">
                <x-heroicon-o-document-text class="w-4 h-4 mr-2" />
                Dokumen Pendaftaran
            </h4>
            <p class="text-sm text-gray-400 italic">Belum ada dokumen yang diupload.</p>
        </div>
        @endif

        {{-- Section Hasil Tes Minat & Bakat --}}
        @if($registrant->examResult)
        <div class="mt-4 pt-4 border-t">
            <h4 class="font-bold text-sm text-gray-800 mb-3 flex items-center">
                <x-heroicon-o-clipboard-document-check class="w-4 h-4 mr-2 text-purple-600" />
                Hasil Tes Minat & Bakat
                <span class="ml-2 px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded-full">Selesai</span>
            </h4>
            <div class="grid grid-cols-2 gap-3">
                {{-- Hasil Tes 1 --}}
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-2">
                    <p class="text-xs font-semibold text-gray-500 mb-2 text-center">Tes Jurusan</p>
                    <a href="{{ asset('storage/exam_results/' . $registrant->examResult->exam1_image) }}" target="_blank" class="block">
                        <img src="{{ asset('storage/exam_results/' . $registrant->examResult->exam1_image) }}" 
                            alt="Hasil Tes 1" 
                            class="w-full h-20 object-cover rounded border border-gray-200 hover:border-purple-400 transition">
                    </a>
                    <div class="flex gap-1 mt-2">
                        <a href="{{ asset('storage/exam_results/' . $registrant->examResult->exam1_image) }}" target="_blank"
                            class="flex-1 text-center text-xs py-1 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition">
                            <x-heroicon-o-eye class="w-3 h-3 inline" /> Lihat
                        </a>
                        <a href="{{ asset('storage/exam_results/' . $registrant->examResult->exam1_image) }}" download
                            class="flex-1 text-center text-xs py-1 bg-green-50 text-green-600 rounded hover:bg-green-100 transition">
                            <x-heroicon-o-arrow-down-tray class="w-3 h-3 inline" /> Unduh
                        </a>
                    </div>
                </div>
                
                {{-- Hasil Tes 2 --}}
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-2">
                    <p class="text-xs font-semibold text-gray-500 mb-2 text-center">Tes Multiple Intelligences</p>
                    <a href="{{ asset('storage/exam_results/' . $registrant->examResult->exam2_image) }}" target="_blank" class="block">
                        <img src="{{ asset('storage/exam_results/' . $registrant->examResult->exam2_image) }}" 
                            alt="Hasil Tes 2" 
                            class="w-full h-20 object-cover rounded border border-gray-200 hover:border-purple-400 transition">
                    </a>
                    <div class="flex gap-1 mt-2">
                        <a href="{{ asset('storage/exam_results/' . $registrant->examResult->exam2_image) }}" target="_blank"
                            class="flex-1 text-center text-xs py-1 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition">
                            <x-heroicon-o-eye class="w-3 h-3 inline" /> Lihat
                        </a>
                        <a href="{{ asset('storage/exam_results/' . $registrant->examResult->exam2_image) }}" download
                            class="flex-1 text-center text-xs py-1 bg-green-50 text-green-600 rounded hover:bg-green-100 transition">
                            <x-heroicon-o-arrow-down-tray class="w-3 h-3 inline" /> Unduh
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- Delete Button --}}
            <form action="{{ route('admin.registrants.delete-exam-result', $registrant->registration_number) }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    onclick="return confirm('Apakah Anda yakin ingin menghapus hasil tes minat & bakat? Siswa akan dapat mengupload ulang setelah dihapus.')"
                    class="w-full text-xs py-2 bg-red-50 text-red-600 border border-red-200 rounded-lg hover:bg-red-100 transition flex items-center justify-center">
                    <x-heroicon-o-trash class="w-3 h-3 mr-1" />
                    Hapus Hasil Tes (Izinkan Upload Ulang)
                </button>
            </form>
        </div>
        @else
        <div class="mt-4 pt-4 border-t">
            <h4 class="font-bold text-sm text-gray-800 mb-2 flex items-center">
                <x-heroicon-o-clipboard-document-check class="w-4 h-4 mr-2 text-gray-400" />
                Hasil Tes Minat & Bakat
            </h4>
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3">
                <p class="text-sm text-amber-700 flex items-center">
                    <x-heroicon-o-exclamation-triangle class="w-4 h-4 mr-2 flex-shrink-0" />
                    Belum mengikuti tes minat & bakat.
                </p>
            </div>
        </div>
        @endif
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
