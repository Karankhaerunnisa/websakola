<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'title',
        'category',
        'event_date',
        'location',
        'photo',
        'description',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_active' => 'boolean',
    ];

    public static function categories()
    {
        return [
            'akademik' => 'Akademik',
            'keagamaan' => 'Keagamaan',
            'sosial' => 'Sosial',
            'budaya' => 'Budaya',
            'olahraga' => 'Olahraga',
            'kunjungan' => 'Kunjungan Industri',
        ];
    }
}
