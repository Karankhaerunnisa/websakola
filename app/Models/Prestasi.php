<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';

    protected $fillable = [
        'title',
        'category',
        'level',
        'rank',
        'student_name',
        'event_name',
        'achievement_date',
        'photo',
        'description',
        'is_active',
    ];

    protected $casts = [
        'achievement_date' => 'date',
        'is_active' => 'boolean',
    ];

    public static function categories()
    {
        return [
            'akademik' => 'Akademik',
            'non-akademik' => 'Non-Akademik',
            'olahraga' => 'Olahraga',
            'seni' => 'Seni',
            'keagamaan' => 'Keagamaan',
        ];
    }

    public static function levels()
    {
        return [
            'sekolah' => 'Tingkat Sekolah',
            'kota' => 'Tingkat Kota/Kabupaten',
            'provinsi' => 'Tingkat Provinsi',
            'nasional' => 'Tingkat Nasional',
            'internasional' => 'Tingkat Internasional',
        ];
    }
}
