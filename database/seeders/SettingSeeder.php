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
                'value' => 'SMK AL-GHIFARI BANYURESMI',
                'type' => 'string'
            ],
            [
                'key' => 'school_address',
                'value' => 'Jl H.Hasan  Arif No.203, Banyueresmi, Kabupaten Garut Jawa Barat',
                'type' => 'string'
            ],
            [
                'key' => 'school_phone',
                'value' => '+6288 8600 9966',
                'type' => 'string'
            ],
            [
                'key' => 'school_email',
                'value' => 'smkalghifari@gmail.com',
                'type' => 'string'
            ],

            // Registration Config
            [
                'key' => 'academic_year',
                'value' => '2026/2027',
                'type' => 'string'
            ],
            [
                'key' => 'registration_start_date',
                'value' => '2026-01-01',
                'type' => 'date'
            ],
            [
                'key' => 'registration_end_date',
                'value' => '2026-08-15',
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

            // Committee Info
            [
                'key' => 'committee_head_name',
                'value' => 'Muhammad Yajid, S.Pd',
                'type' => 'string'
            ],
            [
                'key' => 'committee_head_nip',
                'value' => '',
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
