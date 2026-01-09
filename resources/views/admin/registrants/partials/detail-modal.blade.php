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

            <div class="text-gray-500">Jurusan 1</div>
            <div class="font-medium text-gray-800">{{ $registrant->major->name }}</div>

            <div class="text-gray-500">Jurusan 2</div>
            <div class="font-medium text-gray-800">{{ $registrant->major2?->name ?? '-' }}</div>

            <div class="text-gray-500">Asal Sekolah</div>
            <div class="font-medium text-gray-800">{{ $registrant->academic->school_name ?? '-' }}</div>

            <!--<div class="text-gray-500">Rata-rata Nilai</div>
            <div class="font-medium text-gray-800">{{ $registrant->academic->average_score ?? '0' }}</div>-->

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
                        'ktp_orangtua' => 'KTP Orangtua',
                        'kip' => 'Kartu Indonesia Pintar (KIP)',
                        'akta_kelahiran' => 'Akta Kelahiran',
                        'pas_foto' => 'Pas Foto',
                        'ijazah_skl' => 'Ijazah/SKL',
                        'surat_dokter' => 'Surat Keterangan Sehat',
                        'sertifikat_prestasi' => 'Sertifikat Prestasi',
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

        {{-- Section Data Prestasi (Jalur Prestasi) --}}
        @if($registrant->registration_path === 'prestasi')
        <div class="mt-4 pt-4 border-t">
            <h4 class="font-bold text-sm text-gray-800 mb-3 flex items-center">
                <x-heroicon-o-trophy class="w-4 h-4 mr-2 text-amber-500" />
                Data Prestasi (Jalur Prestasi)
                <span class="ml-2 px-2 py-0.5 text-xs bg-amber-100 text-amber-700 rounded-full">Jalur Prestasi</span>
            </h4>
            
            {{-- Prestasi Akademik (Peringkat Semester) --}}
            @if($registrant->academicAchievements && $registrant->academicAchievements->count() > 0)
            <div class="mb-4">
                <h5 class="text-xs font-bold text-gray-600 uppercase mb-2 flex items-center">
                    <x-heroicon-o-academic-cap class="w-3 h-3 mr-1 text-blue-500" />
                    Prestasi Akademik (Peringkat Kelas)
                </h5>
                <div class="bg-blue-50 rounded-lg border border-blue-200 overflow-hidden">
                    <table class="w-full text-xs">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-blue-800">Semester</th>
                                <th class="px-3 py-2 text-left font-semibold text-blue-800">Peringkat</th>
                                <th class="px-3 py-2 text-left font-semibold text-blue-800">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-100">
                            @foreach($registrant->academicAchievements as $achievement)
                            <tr>
                                <td class="px-3 py-2 text-gray-700">Semester {{ $achievement->semester }}</td>
                                <td class="px-3 py-2 font-bold text-blue-700">Peringkat {{ $achievement->peringkat }}</td>
                                <td class="px-3 py-2 text-gray-600">{{ $achievement->keterangan ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- Prestasi Non-Akademik (Lomba/Kejuaraan) --}}
            @if($registrant->nonAcademicAchievements && $registrant->nonAcademicAchievements->count() > 0)
            <div>
                <h5 class="text-xs font-bold text-gray-600 uppercase mb-2 flex items-center">
                    <x-heroicon-o-star class="w-3 h-3 mr-1 text-yellow-500" />
                    Prestasi Non-Akademik (Lomba/Kejuaraan)
                </h5>
                <div class="bg-amber-50 rounded-lg border border-amber-200 overflow-hidden">
                    <table class="w-full text-xs">
                        <thead class="bg-amber-100">
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-amber-800">Nama Lomba</th>
                                <th class="px-3 py-2 text-left font-semibold text-amber-800">Tingkat</th>
                                <th class="px-3 py-2 text-left font-semibold text-amber-800">Juara</th>
                                <th class="px-3 py-2 text-left font-semibold text-amber-800">Tahun</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-amber-100">
                            @foreach($registrant->nonAcademicAchievements as $achievement)
                            @php
                                $tingkatLabels = [
                                    'sekolah' => 'Sekolah',
                                    'kecamatan' => 'Kecamatan',
                                    'kabupaten' => 'Kabupaten/Kota',
                                    'provinsi' => 'Provinsi',
                                    'nasional' => 'Nasional',
                                    'internasional' => 'Internasional',
                                ];
                                $peringkatLabels = [
                                    'juara_1' => 'Juara 1',
                                    'juara_2' => 'Juara 2',
                                    'juara_3' => 'Juara 3',
                                    'harapan_1' => 'Harapan 1',
                                    'harapan_2' => 'Harapan 2',
                                    'harapan_3' => 'Harapan 3',
                                    'peserta' => 'Peserta',
                                ];
                            @endphp
                            <tr>
                                <td class="px-3 py-2 font-medium text-gray-800">{{ $achievement->nama_lomba }}</td>
                                <td class="px-3 py-2 text-gray-600">{{ $tingkatLabels[$achievement->tingkat] ?? $achievement->tingkat }}</td>
                                <td class="px-3 py-2 font-bold text-amber-700">{{ $peringkatLabels[$achievement->peringkat] ?? $achievement->peringkat }}</td>
                                <td class="px-3 py-2 text-gray-600">{{ $achievement->tahun ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if((!$registrant->academicAchievements || $registrant->academicAchievements->count() == 0) && (!$registrant->nonAcademicAchievements || $registrant->nonAcademicAchievements->count() == 0))
            <p class="text-sm text-gray-400 italic">Tidak ada data prestasi yang diinput.</p>
            @endif
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
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Pilihan Jurusan 1</label>
                <select name="major_id"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @foreach($majors as $major)
                    <option value="{{ $major->id }}" {{ $registrant->major_id === $major->id ? 'selected' : '' }}>
                        {{ $major->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!--<div class="mb-4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Pilihan Jurusan 2</label>
                <select name="major_id_2"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">-- Tidak Ada --</option>
                    @foreach($majors as $major)
                    <option value="{{ $major->id }}" {{ $registrant->major_id_2 === $major->id ? 'selected' : '' }}>
                        {{ $major->name }}
                    </option>
                    @endforeach
                </select>
            </div>-->

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
