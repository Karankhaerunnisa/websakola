<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    use HasFactory;

    protected $table = 'ekskul';

    protected $fillable = [
        'name',
        'category',
        'schedule',
        'instructor',
        'photo',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function categories()
    {
        return [
            'olahraga' => 'Olahraga',
            'seni' => 'Seni & Budaya',
            'akademik' => 'Akademik',
            'keagamaan' => 'Keagamaan',
            'teknologi' => 'Teknologi',
            'sosial' => 'Sosial',
        ];
    }
}
