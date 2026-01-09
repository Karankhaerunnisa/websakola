<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrantNonAcademicAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'registrant_id',
        'nama_lomba',
        'tingkat',
        'peringkat',
        'tahun',
    ];

    /**
     * Get the registrant that owns the achievement.
     */
    public function registrant()
    {
        return $this->belongsTo(Registrant::class);
    }

    /**
     * Get tingkat label for display.
     */
    public function getTingkatLabelAttribute(): string
    {
        return match($this->tingkat) {
            'sekolah' => 'Sekolah',
            'kecamatan' => 'Kecamatan',
            'kabupaten' => 'Kabupaten/Kota',
            'provinsi' => 'Provinsi',
            'nasional' => 'Nasional',
            'internasional' => 'Internasional',
            default => $this->tingkat ?? '-',
        };
    }

    /**
     * Get peringkat label for display.
     */
    public function getPeringkatLabelAttribute(): string
    {
        return match($this->peringkat) {
            'juara_1' => 'Juara 1',
            'juara_2' => 'Juara 2',
            'juara_3' => 'Juara 3',
            'harapan_1' => 'Harapan 1',
            'harapan_2' => 'Harapan 2',
            'harapan_3' => 'Harapan 3',
            'peserta' => 'Peserta',
            default => $this->peringkat ?? '-',
        };
    }
}
