<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumumanujian extends Model
{
    protected $table = 'pengumumanujians';
    protected $fillable = [
        'registrant_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public function registrant()
    {
        return $this->belongsTo(Registrant::class);
    }
}
