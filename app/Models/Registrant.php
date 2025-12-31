<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\RegistrantStatus;
use App\Enums\Religion;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Registrant extends Model
{
    /** @use HasFactory<\Database\Factories\RegistrantFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'gender' => Gender::class,
            'religion' => Religion::class,
            'status' => RegistrantStatus::class,
        ];
    }

    protected function whatsappUrl(): Attribute
    {
        return Attribute::make(
            get: function(mixed $value, array $attributes): ?string {
                $phone = $attributes['phone'] ?? null;

                if (!$phone) {
                    return null;
                }

                $sanitized = preg_replace('/^0/', '62', preg_replace('/\D/', '', $phone));

                return "https://wa.me/{$sanitized}";
            }
        );
    }

    public function getRouteKeyName(): string
    {
        return 'registration_number';
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(RegistrantAddress::class, 'registrant_id');
    }

    public function guardians(): HasMany
    {
        return $this->hasMany(RegistrantGuardian::class, 'registrant_id');
    }

    public function academic(): HasOne
    {
        return $this->hasOne(RegistrantAcademic::class, 'registrant_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(RegistrantDocument::class, 'registrant_id');
    }

    public function examResult(): HasOne
    {
        return $this->hasOne(ExamResult::class, 'registrant_id');
    }
}
