<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamResult extends Model
{
    protected $fillable = [
        'registrant_id',
        'exam1_image',
        'exam2_image',
    ];

    public function registrant(): BelongsTo
    {
        return $this->belongsTo(Registrant::class);
    }
}
