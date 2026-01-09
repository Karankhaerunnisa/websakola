<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrantAcademicAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'registrant_id',
        'semester',
        'peringkat',
        'keterangan',
    ];

    /**
     * Get the registrant that owns the achievement.
     */
    public function registrant()
    {
        return $this->belongsTo(Registrant::class);
    }

    /**
     * Get peringkat label for display.
     */
    public function getPeringkatLabelAttribute(): string
    {
        return match($this->peringkat) {
            '1' => 'Peringkat 1',
            '2' => 'Peringkat 2',
            '3' => 'Peringkat 3',
            '4' => 'Peringkat 4',
            '5' => 'Peringkat 5',
            '6-10' => 'Peringkat 6-10',
            '11+' => 'Peringkat 11+',
            default => $this->peringkat ?? '-',
        };
    }
}
