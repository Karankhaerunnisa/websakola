<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'name',
        'graduation_year',
        'major',
        'photo',
        'current_position',
        'company',
        'testimonial',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
