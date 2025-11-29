<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'school_name',
                'value' => 'SMK Negeri 1 Digital',
                'type' => 'string'
            ],
            [
                'key' => 'school_address',
                'value' => 'Jl. Teknologi No. 404, Cyber City',
                'type' => 'string'
            ],
            [
                'key' => 'school_phone',
                'value' => '(021) 555-0199',
                'type' => 'string'
            ],
            [
                'key' => 'school_email',
                'value' => 'info@smk1digital.sch.id',
                'type' => 'string'
            ],

            // Registration Config
            [
                'key' => 'academic_year',
                'value' => '2025/2026',
                'type' => 'string'
            ],
            [
                'key' => 'registration_start_date',
                'value' => '2025-06-01',
                'type' => 'date'
            ],
            [
                'key' => 'registration_end_date',
                'value' => '2025-07-15',
                'type' => 'date'
            ],
            [
                'key' => 'is_registration_open',
                'value' => '1',
                'type' => 'boolean'
            ],

            // Assets
            [
                'key' => 'app_logo',
                'value' => 'school-logo.jpg',
                'type' => 'string'
            ],

            [
                'key' => 'document_header',
                'value' => 'letter-head.png',
                'type' => 'string'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create([
                'key' => $setting['key'],
                'value' => $setting['value'],
                'type' => $setting['type']
            ]);
        }
    }
}
