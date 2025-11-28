<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @use HasFactory<\Database\Factories\SettingFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public static function getValue(string $key, $default = null) {
        $setting = self::where('key', $key)->first();

        if ($setting) {
            return match($setting->type) {
                'boolean' => (bool) $setting->value,
                'integer' => (int) $setting->value,
                default => $setting->value
            };
        }

        return $default;
    }
}
