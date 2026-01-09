<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraSmk extends Model
{
    use HasFactory;

    protected $table = 'mitra_smk';

    protected $fillable = [
        'name',
        'category',
        'logo',
        'website',
        'address',
        'partnership_type',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function categories()
    {
        return [
            'industri' => 'Dunia Industri',
            'pendidikan' => 'Pendidikan',
            'pemerintah' => 'Pemerintahan',
            'swasta' => 'Swasta',
            'bumn' => 'BUMN/BUMD',
        ];
    }

    public static function partnershipTypes()
    {
        return [
            'magang' => 'Praktek Kerja Lapangan (PKL/Magang)',
            'rekrutmen' => 'Rekrutmen Tenaga Kerja',
            'pelatihan' => 'Pelatihan & Sertifikasi',
            'beasiswa' => 'Beasiswa',
            'kunjungan' => 'Kunjungan Industri',
        ];
    }
}
