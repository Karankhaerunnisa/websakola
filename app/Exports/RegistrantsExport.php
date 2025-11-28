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
            ->with(['major', 'guardians'])
            ->when($this->request->majorCode, function ($query, $majorCode) {
                $query->whereRelation('major', 'code', $majorCode);
            })
            ->when($this->request->status, fn($q, $s) => $q->where('status', $s))
            ->when($this->request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('registration_number', 'like', "%{$search}%");
                });
            });
    }

    /**
     * Define the Excel Header Row
     */
    public function headings(): array
    {
        return [
            'No. Pendaftaran',
            'Nama Lengkap',
            'Jurusan',
            'Jenis Kelamin',
            'Asal Sekolah',
            'No. HP',
            'Status',
            'Tanggal Daftar',
        ];
    }

    /**
     * Map the data for each row
     */
    public function map($registrant): array
    {
        return [
            $registrant->registration_number,
            $registrant->name,
            $registrant->major->name,
            $registrant->gender->label(),
            $registrant->academic->school_name ?? '-',
            $registrant->phone ?? $registrant->phone ?? '-',
            $registrant->status->label(),
            $registrant->created_at->format('d-m-Y H:i'),
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
