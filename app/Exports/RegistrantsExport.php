<?php

namespace App\Exports;

use App\Models\Registrant;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Http\Request;

class RegistrantsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $request;

    // We pass the Request so we can apply the same filters (Search, Major, Status)
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Define the query. We copy the exact logic from your Controller here.
     */
    public function query()
    {
        return Registrant::query()
            ->with(['major', 'address', 'academic', 'pengumumanUjian', 'academicAchievements', 'nonAcademicAchievements'])
            ->when($this->request->majorCode, function ($query, $majorCode) {
                $query->whereRelation('major', 'code', $majorCode);
            })
            ->when($this->request->status, fn($q, $s) => $q->where('status', $s))
            ->when($this->request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('registration_number', 'like', "%{$search}%")
                        ->orWhere('nisn', 'like', "%{$search}%");
                });
            })
            ->when($this->request->schoolSearch, function ($query, $schoolSearch) {
                $query->whereHas('academic', function ($q) use ($schoolSearch) {
                    $q->where('school_name', 'like', "%{$schoolSearch}%");
                });
            });
    }

    /**
     * Define the Excel Header Row
     */
    public function headings(): array
    {
        return [
            'No. Register',
            'Tanggal Daftar',
            'Jurusan',
            'Jalur Daftar',
            'Nama Lengkap',
            'NISN',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Agama',
            'Alamat Lengkap',
            'RT',
            'RW',
            'Kode Pos',
            'Desa/Kelurahan',
            'Kecamatan',
            'Kabupaten/Kota',
            'Provinsi',
            'No. HP',
            'Email',
            'Asal Sekolah',
            'Tahun Lulus',
            'Prestasi Akademik',
            'Prestasi Non-Akademik',
            'Status Lulus',
        ];
    }

    /**
     * Map the data for each row
     */
    public function map($registrant): array
    {
        // Get registration path label
        $registrationPath = match($registrant->registration_path ?? 'umum') {
            'umum' => 'Jalur Umum',
            'prestasi' => 'Jalur Prestasi',
            default => '-',
        };

        // Get religion label
        $religionLabel = $registrant->religion ? $registrant->religion->label() : '-';

        // Get gender label
        $genderLabel = $registrant->gender ? $registrant->gender->label() : '-';

        // Get pengumuman ujian status (Lulus/Tidak Lulus)
        $statusLulus = $registrant->pengumumanUjian ? $registrant->pengumumanUjian->status : 'Belum Diumumkan';

        // Format Prestasi Akademik
        $prestasiAkademik = '-';
        if ($registrant->academicAchievements && $registrant->academicAchievements->count() > 0) {
            $prestasiList = [];
            foreach ($registrant->academicAchievements as $achievement) {
                $prestasiList[] = "Smt {$achievement->semester}: Peringkat {$achievement->peringkat}";
            }
            $prestasiAkademik = implode(', ', $prestasiList);
        }

        // Format Prestasi Non-Akademik
        $prestasiNonAkademik = '-';
        if ($registrant->nonAcademicAchievements && $registrant->nonAcademicAchievements->count() > 0) {
            $tingkatLabels = [
                'sekolah' => 'Sekolah',
                'kecamatan' => 'Kecamatan',
                'kabupaten' => 'Kab/Kota',
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
            
            $lombaList = [];
            foreach ($registrant->nonAcademicAchievements as $achievement) {
                $tingkat = $tingkatLabels[$achievement->tingkat] ?? $achievement->tingkat;
                $peringkat = $peringkatLabels[$achievement->peringkat] ?? $achievement->peringkat;
                $lombaList[] = "{$achievement->nama_lomba} ({$tingkat}, {$peringkat}, {$achievement->tahun})";
            }
            $prestasiNonAkademik = implode('; ', $lombaList);
        }

        return [
            $registrant->registration_number,
            $registrant->created_at->format('d-m-Y'),
            $registrant->major->name ?? '-',
            $registrationPath,
            $registrant->name,
            $registrant->nisn,
            $registrant->nik,
            $registrant->birth_place ?? '-',
            $registrant->birth_date ? $registrant->birth_date->format('d-m-Y') : '-',
            $genderLabel,
            $religionLabel,
            $registrant->address->street_address ?? '-',
            $registrant->address->rt ?? '-',
            $registrant->address->rw ?? '-',
            $registrant->address->postal_code ?? '-',
            $registrant->address->village ?? '-',
            $registrant->address->district ?? '-',
            $registrant->address->city ?? '-',
            $registrant->address->province ?? '-',
            $registrant->phone ?? '-',
            $registrant->email ?? '-',
            $registrant->academic->school_name ?? '-',
            $registrant->academic->graduation_year ?? '-',
            $prestasiAkademik,
            $prestasiNonAkademik,
            $statusLulus,
        ];
    }

    /**
     * Optional: Make the header bold
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
