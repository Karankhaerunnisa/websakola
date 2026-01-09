<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Status - {{ \App\Models\Setting::getValue('school_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased min-h-screen flex flex-col">

    
    {{-- Navigation --}}
    <nav x-data="{ open: false }" class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/' . \App\Models\Setting::getValue('app_logo', 'default.png')) }}"
                            class="h-10 w-auto" alt="Logo">
                        <div>
                            <div class="font-bold text-blue-900 leading-tight">
                                {{ \App\Models\Setting::getValue('school_name') }}
                            </div>
                            <div class="text-xs text-gray-500">
                                SPMB Online {{ \App\Models\Setting::getValue('academic_year') }}
                            </div>
                        </div>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-4 relative z-10">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition cursor-pointer">
                        <x-heroicon-o-home class="w-4 h-4 mr-1" />
                        Beranda
                    </a>
                    <a href="{{ route('formulir') }}"
                        class="text-sm font-medium {{ request()->routeIs('formulir') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition cursor-pointer">
                        <x-heroicon-o-pencil-square class="w-4 h-4 mr-1" />
                        Formulir
                    </a>
                    <a href="{{ route('registration.check-status.form') }}"
                        class="text-sm font-medium {{ request()->routeIs('registration.check-status.form') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition cursor-pointer">
                        <x-heroicon-o-clipboard-document-check class="w-4 h-4 mr-1" />
                        Cek Status
                    </a>
                    <a href="{{ route('ujian-tes') }}"
                        class="text-sm font-medium {{ request()->routeIs('ujian-tes') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition cursor-pointer">
                        <x-heroicon-o-document-text class="w-4 h-4 mr-1" />
                        Tes Minat & Bakat
                    </a>
                    <a href="{{ route('pengumuman-seleksi') }}"
                        class="text-sm font-medium {{ request()->routeIs('pengumuman-seleksi') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} flex items-center transition cursor-pointer">
                        <x-heroicon-o-academic-cap class="w-4 h-4 mr-1" />
                        Pengumuman Seleksi
                    </a>
                    
                </div>

                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">

                        <x-heroicon-o-bars-3 class="h-6 w-6" x-show="!open" />

                        <x-heroicon-o-x-mark class="h-6 w-6" x-show="open" style="display: none;" />
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden border-t border-gray-100 bg-white"
            style="display: none;">

            <div class="pt-2 pb-3 space-y-1 px-4">
                <a href="{{ route('home') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-home class="w-5 h-5 mr-2" />
                        Beranda
                    </div>
                </a>
                <a href="{{ route('formulir') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('formulir') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-pencil-square class="w-5 h-5 mr-2" />
                        Formulir
                    </div>
                </a>
                <a href="{{ route('registration.check-status.form') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('registration.check-status.form') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-clipboard-document-check class="w-5 h-5 mr-2" />
                        Cek Status
                    </div>
                </a>
                <a href="{{ route('ujian-tes') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('ujian-tes') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-document-text class="w-5 h-5 mr-2" />
                        Tes Minat & Bakat
                    </div>
                </a>
                <a href="{{ route('pengumuman-seleksi') }}"
                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('pengumuman-seleksi') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                    <div class="flex items-center">
                        <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" />
                        Pengumuman Seleksi
                    </div>
                </a>
                
            </div>
        </div>
    </nav>

    <main class="flex-grow flex flex-col items-center p-4 py-8">

        {{-- Header Section --}}
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full mb-4 shadow-lg">
                <x-heroicon-o-magnifying-glass class="w-8 h-8 text-white" />
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Cek Status</h1>
            <p class="text-gray-500">Pilih jenis pengecekan status yang ingin Anda lakukan</p>
        </div>

        {{-- Tab Container --}}
        <div class="w-full max-w-lg" x-data="{ activeTab: '{{ isset($examRegistrant) ? 'upload' : 'persyaratan' }}' }">
            
            {{-- Tab Buttons --}}
            <div class="flex mb-6 bg-gray-100 rounded-xl p-1.5">
                <button @click="activeTab = 'persyaratan'" 
                    :class="activeTab === 'persyaratan' ? 'bg-white shadow-md text-blue-600' : 'text-gray-600 hover:text-gray-800'"
                    class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-lg font-semibold text-sm transition-all duration-200">
                    <x-heroicon-o-clipboard-document-check class="w-5 h-5" />
                    <span>Kelengkapan Persyaratan</span>
                </button>
                <button @click="activeTab = 'upload'"
                    :class="activeTab === 'upload' ? 'bg-white shadow-md text-purple-600' : 'text-gray-600 hover:text-gray-800'"
                    class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-lg font-semibold text-sm transition-all duration-200">
                    <x-heroicon-o-cloud-arrow-up class="w-5 h-5" />
                    <span>Upload Tes</span>
                </button>
            </div>

            {{-- Tab Content: Kelengkapan Persyaratan --}}
            <div x-show="activeTab === 'persyaratan'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                        <h2 class="text-lg font-bold text-white flex items-center">
                            <x-heroicon-o-clipboard-document-check class="w-5 h-5 mr-2" />
                            Cek Kelengkapan Persyaratan
                        </h2>
                        <p class="text-blue-100 text-sm mt-1">Cek status dokumen pendaftaran Anda</p>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('registration.check-status') }}" method="POST">
                            @csrf

                            @if(session('error'))
                            <div class="bg-red-50 text-red-600 text-sm p-3 rounded-md mb-4 flex items-center">
                                <x-heroicon-o-exclamation-circle class="w-5 h-5 mr-2" />
                                {{ session('error') }}
                            </div>
                            @endif

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Pendaftaran / NISN <span class="text-red-500">*</span></label>
                                    <input type="text" name="registration_number" value="{{ old('registration_number') }}"
                                        required placeholder="Contoh: PPDB2025XXXXX atau NISN"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 uppercase">
                                    <p class="text-xs text-gray-500 mt-1">Masukkan Nomor Pendaftaran atau NISN Anda.</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                                    <input type="date" name="birth_date" value="{{ old('birth_date') }}" required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <p class="text-xs text-gray-500 mt-1">Digunakan untuk verifikasi keamanan.</p>
                                </div>

                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-3 rounded-md hover:from-blue-700 hover:to-indigo-700 transition shadow-md flex items-center justify-center">
                                    <x-heroicon-o-magnifying-glass class="w-5 h-5 mr-2" />
                                    Cek Status Persyaratan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Result Section (for Kelengkapan Persyaratan) - Inside Tab --}}
                @if(isset($registrant))
                <div class="mt-6 bg-white rounded-xl shadow-lg border border-blue-100 overflow-hidden animate-fade-in-up">
                    <div class="p-6 text-center border-b border-gray-100">
                        <div class="mb-2">
                            <span class="px-4 py-1.5 rounded-full text-sm font-bold bg-{{ $registrant->status->color() }}-100 text-{{ $registrant->status->color() }}-700">
                                {{ $registrant->status->label() }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $registrant->name }}</h3>
                        <p class="text-gray-500 text-sm">{{ $registrant->registration_number }}</p>
                    </div>

                    <div class="p-6 bg-gray-50 space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Jurusan Pilihan 1</span>
                            <span class="font-medium text-gray-900">{{ $registrant->major->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Jurusan Pilihan 2</span>
                            <span class="font-medium text-gray-900">{{ $registrant->major2?->name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Jalur Pendaftaran</span>
                            <span class="font-medium">
                                @if($registrant->registration_path == 'umum' || $registrant->registration_path == '1' || $registrant->registration_path == null)
                                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs">Jalur Umum</span>
                                @else
                                    <span class="px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full text-xs">Jalur Prestasi</span>
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tanggal Daftar</span>
                            <span class="font-medium text-gray-900">{{ $registrant->created_at->format('d M Y') }}</span>
                        </div>

                        @if($registrant->admin_note)
                        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-md text-left">
                            <span class="block text-xs font-bold text-yellow-700 uppercase mb-1">Catatan Panitia:</span>
                            <p class="text-gray-700">{{ $registrant->admin_note }}</p>
                        </div>
                        @endif
                    </div>

                    {{-- Kelengkapan Persyaratan --}}
                    <div class="p-6 border-t border-gray-100">
                        <h4 class="text-sm font-bold text-gray-800 mb-3 flex items-center">
                            <x-heroicon-o-clipboard-document-check class="w-4 h-4 mr-1" />
                            Kelengkapan Persyaratan
                        </h4>
                        @php
                            // Dokumen wajib untuk semua jalur
                            $requiredDocs = [
                                'kartu_keluarga' => 'Kartu Keluarga (KK)',
                                'ktp_orangtua' => 'KTP Orangtua',
                                'kip' => 'Kartu Indonesia Pintar (KIP)',
                                'akta_kelahiran' => 'Akta Kelahiran',
                                'pas_foto' => 'Pas Foto',
                                'ijazah_skl' => 'Ijazah / SKL',
                                'surat_dokter' => 'Surat Keterangan Sehat',
                            ];
                            
                            // Cek apakah peserta memilih jalur prestasi
                            $isPrestasiPath = !($registrant->registration_path == 'umum' || $registrant->registration_path == '1' || $registrant->registration_path == null);
                            
                            // Tambahkan sertifikat prestasi hanya untuk jalur prestasi
                            if ($isPrestasiPath) {
                                $requiredDocs['sertifikat_prestasi'] = 'Prestasi / Piagam';
                            }
                            
                            $uploadedDocs = $registrant->documents->pluck('document_type')->toArray();
                            $missingDocs = array_diff(array_keys($requiredDocs), $uploadedDocs);
                        @endphp

                        {{-- Success Message --}}
                        @if(session('success'))
                        <div class="bg-green-50 text-green-600 text-sm p-3 rounded-md mb-4 flex items-center">
                            <x-heroicon-o-check-circle class="w-5 h-5 mr-2" />
                            {{ session('success') }}
                        </div>
                        @endif

                        {{-- Error Message --}}
                        @if(session('upload_error'))
                        <div class="bg-red-50 text-red-600 text-sm p-3 rounded-md mb-4 flex items-center">
                            <x-heroicon-o-exclamation-circle class="w-5 h-5 mr-2" />
                            {{ session('upload_error') }}
                        </div>
                        @endif
                        
                        <form action="{{ route('registration.upload-documents') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="registration_number" value="{{ $registrant->registration_number }}">
                            <input type="hidden" name="birth_date" value="{{ $registrant->birth_date->format('Y-m-d') }}">
                            
                            <div class="space-y-3">
                                @foreach($requiredDocs as $type => $label)
                                <div class="rounded-lg border {{ in_array($type, $uploadedDocs) ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }} p-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium {{ in_array($type, $uploadedDocs) ? 'text-green-800' : 'text-red-800' }}">
                                            {{ $label }}
                                        </span>
                                        @if(in_array($type, $uploadedDocs))
                                            @php
                                                $doc = $registrant->documents->where('document_type', $type)->first();
                                            @endphp
                                            <div class="flex items-center gap-2">
                                                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" 
                                                   class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded hover:bg-green-200 transition">
                                                    <x-heroicon-o-eye class="w-3 h-3 inline" /> Lihat
                                                </a>
                                                <span class="flex items-center text-green-600 text-xs">
                                                    <x-heroicon-o-check-circle class="w-4 h-4 mr-1" />
                                                    Lengkap
                                                </span>
                                            </div>
                                        @else
                                            <span class="flex items-center text-red-600 text-xs">
                                                <x-heroicon-o-x-circle class="w-4 h-4 mr-1" />
                                                Belum Upload
                                            </span>
                                        @endif
                                    </div>
                                    
                                    {{-- Upload Field for missing documents --}}
                                    @if(!in_array($type, $uploadedDocs))
                                    <div class="mt-3">
                                        <label class="block">
                                            <span class="sr-only">Pilih file untuk {{ $label }}</span>
                                            <input type="file" name="documents[{{ $type }}]" accept=".pdf,.jpg,.jpeg,.png"
                                                class="block w-full text-sm text-gray-500
                                                file:mr-4 file:py-2 file:px-4
                                                file:rounded-md file:border-0
                                                file:text-sm file:font-semibold
                                                file:bg-blue-50 file:text-blue-700
                                                hover:file:bg-blue-100
                                                cursor-pointer">
                                        </label>
                                        <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG. Maksimal 2MB</p>
                                        @error('documents.' . $type)
                                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>

                            {{-- Submit Button - Only show if there are missing documents --}}
                            @if(count($missingDocs) > 0)
                            <div class="mt-4">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-3 rounded-md hover:from-blue-700 hover:to-indigo-700 transition shadow-md flex items-center justify-center">
                                    <x-heroicon-o-cloud-arrow-up class="w-5 h-5 mr-2" />
                                    Simpan Dokumen
                                </button>
                            </div>
                            @else
                            <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg text-center">
                                <p class="text-sm text-green-700 flex items-center justify-center">
                                    <x-heroicon-o-check-badge class="w-5 h-5 mr-2" />
                                    Semua dokumen persyaratan sudah lengkap!
                                </p>
                            </div>
                            @endif
                        </form>
                    </div>

                    {{-- Print Registration Button --}}
                    <div class="p-4 bg-gray-50 border-t border-gray-100">
                        <a href="{{ route('registration.print', $registrant->registration_number) }}" target="_blank"
                            class="block w-full text-center bg-white border border-gray-300 text-gray-700 font-medium py-2 rounded-md hover:bg-gray-50 transition">
                            <x-heroicon-o-printer class="w-4 h-4 inline mr-1" />
                            Cetak Bukti Pendaftaran
                        </a>
                    </div>
                </div>
                @endif
            </div>

            {{-- Tab Content: Upload Tes --}}
            <div x-show="activeTab === 'upload'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;"
                x-data="{
                    regNumber: '',
                    loading: false,
                    searched: false,
                    error: null,
                    result: null,
                    async checkStatus() {
                        if (!this.regNumber.trim()) {
                            this.error = 'Nomor pendaftaran wajib diisi.';
                            return;
                        }
                        this.loading = true;
                        this.error = null;
                        this.result = null;
                        
                        try {
                            const response = await fetch('{{ route('registration.check-exam-status.ajax') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ registration_number: this.regNumber.toUpperCase() })
                            });
                            const data = await response.json();
                            
                            if (data.success) {
                                this.result = data;
                            } else {
                                this.error = data.message;
                            }
                        } catch (err) {
                            this.error = 'Terjadi kesalahan. Silakan coba lagi.';
                        }
                        
                        this.loading = false;
                        this.searched = true;
                    }
                }">
                <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="bg-blue-600 px-6 py-4">
                        <h2 class="text-lg font-bold text-white flex items-center">
                            <x-heroicon-o-cloud-arrow-up class="w-5 h-5 mr-2" />
                            Cek Status Upload Tes
                        </h2>
                        <p class="text-purple-100 text-sm mt-1">Cek status upload hasil tes minat & bakat</p>
                    </div>

                    <div class="p-6">
                        {{-- Error Message --}}
                        <div x-show="error" x-transition class="bg-red-50 text-red-600 text-sm p-3 rounded-md mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span x-text="error"></span>
                        </div>

                        <p class="text-sm text-gray-600 mb-4">Masukkan nomor pendaftaran untuk mengecek status upload hasil tes minat & bakat Anda:</p>
                        
                        <form @submit.prevent="checkStatus()" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Pendaftaran <span class="text-red-500">*</span></label>
                                <input type="text" x-model="regNumber"
                                    required placeholder="Contoh: PPDB2025XXXXX"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 uppercase">
                            </div>
                            
                            <button type="submit" :disabled="loading"
                                class="w-full bg-blue-600 text-white font-bold py-3 rounded-md transition shadow-md flex items-center justify-center disabled:opacity-50">
                                <template x-if="loading">
                                    <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </template>
                                <template x-if="!loading">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </template>
                                <span x-text="loading ? 'Mencari...' : 'Cek Status Upload'"></span>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Result Section for Exam Status (AJAX) --}}
                <div x-show="result" x-transition class="mt-4 bg-white rounded-xl shadow-lg border border-purple-100 overflow-hidden">
                    <div class="p-4 text-center border-b border-gray-100 bg-gradient-to-r from-purple-50 to-pink-50">
                        <h3 class="text-lg font-bold text-gray-900" x-text="result?.registrant?.name"></h3>
                        <p class="text-gray-500 text-sm" x-text="result?.registrant?.registration_number"></p>
                    </div>

                    <div class="p-6">
                        {{-- Upload Complete --}}
                        <template x-if="result?.exam_result?.exam1_image && result?.exam_result?.exam2_image">
                            <div>
                                <div class="text-center mb-5">
                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-3">
                                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-bold text-green-800">Tes Minat & Bakat Selesai!</h4>
                                    <p class="text-sm text-green-600">Kedua hasil tes sudah berhasil diupload.</p>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    {{-- Tes Jurusan --}}
                                    <div class="bg-gray-50 rounded-lg border border-gray-200 p-3">
                                        <div class="flex items-center justify-between mb-2">
                                            <p class="text-sm font-bold text-purple-700">Tes Jurusan</p>
                                            <span class="px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded-full">Uploaded</span>
                                        </div>
                                        <a :href="result?.exam_result?.exam1_image" target="_blank" class="block">
                                            <img :src="result?.exam_result?.exam1_image" alt="Hasil Tes Jurusan" 
                                                class="w-full h-28 object-cover rounded-lg border border-gray-200 hover:border-purple-400 transition">
                                        </a>
                                        <a :href="result?.exam_result?.exam1_image" target="_blank"
                                            class="mt-2 w-full block text-center text-xs py-1.5 bg-purple-50 text-purple-600 rounded hover:bg-purple-100 transition">
                                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg> Lihat Gambar
                                        </a>
                                    </div>
                                    
                                    {{-- Tes Multiple Intelligences --}}
                                    <div class="bg-gray-50 rounded-lg border border-gray-200 p-3">
                                        <div class="flex items-center justify-between mb-2">
                                            <p class="text-sm font-bold text-pink-700">Tes Multiple Intelligences</p>
                                            <span class="px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded-full">Uploaded</span>
                                        </div>
                                        <a :href="result?.exam_result?.exam2_image" target="_blank" class="block">
                                            <img :src="result?.exam_result?.exam2_image" alt="Hasil Tes Multiple Intelligences" 
                                                class="w-full h-28 object-cover rounded-lg border border-gray-200 hover:border-pink-400 transition">
                                        </a>
                                        <a :href="result?.exam_result?.exam2_image" target="_blank"
                                            class="mt-2 w-full block text-center text-xs py-1.5 bg-pink-50 text-pink-600 rounded hover:bg-pink-100 transition">
                                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg> Lihat Gambar
                                        </a>
                                    </div>
                                </div>

                                <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg text-center">
                                    <p class="text-xs text-green-700">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Data tes Anda sudah tercatat. Hasil seleksi akan diumumkan di halaman Pengumuman Seleksi.
                                    </p>
                                </div>
                            </div>
                        </template>
                        
                        {{-- Upload Not Complete --}}
                        <template x-if="result && (!result?.exam_result?.exam1_image || !result?.exam_result?.exam2_image)">
                            <div class="text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 rounded-full mb-3">
                                    <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-bold text-amber-800">Belum Mengikuti Tes</h4>
                                <p class="text-sm text-amber-600 mb-2">Anda belum mengupload hasil tes minat & bakat.</p>
                                
                                {{-- Status checklist --}}
                                <div class="my-4 text-left max-w-xs mx-auto space-y-2">
                                    <div class="flex items-center justify-between text-sm py-1.5 px-3 rounded" 
                                        :class="result?.exam_result?.exam1_image ? 'bg-green-50' : 'bg-red-50'">
                                        <span :class="result?.exam_result?.exam1_image ? 'text-green-800' : 'text-red-800'">Tes Jurusan</span>
                                        <span x-show="result?.exam_result?.exam1_image" class="flex items-center text-green-600 text-xs">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg> Uploaded
                                        </span>
                                        <span x-show="!result?.exam_result?.exam1_image" class="flex items-center text-red-600 text-xs">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg> Belum
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm py-1.5 px-3 rounded" 
                                        :class="result?.exam_result?.exam2_image ? 'bg-green-50' : 'bg-red-50'">
                                        <span :class="result?.exam_result?.exam2_image ? 'text-green-800' : 'text-red-800'">Tes Multiple Intelligences</span>
                                        <span x-show="result?.exam_result?.exam2_image" class="flex items-center text-green-600 text-xs">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg> Uploaded
                                        </span>
                                        <span x-show="!result?.exam_result?.exam2_image" class="flex items-center text-red-600 text-xs">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg> Belum
                                        </span>
                                    </div>
                                </div>
                                
                                <a href="{{ route('ujian-tes') }}" 
                                    class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-md hover:from-blue-700 hover:to-indigo-700 transition shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                    Upload Hasil Tes Sekarang
                                </a>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} {{ \App\Models\Setting::getValue('school_name') }}.
    </footer>

</body>

</html>
