<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Announcement::create([
            'title' => 'Penerimaan Peserta Didik Baru 2026/2027',
            'content' => 'Pendaftaran PPDB SMK AL-GHIFARI BANYURESMI Tahun Ajaran 2026/2027 dibuka mulai tanggal 1 Januari 2026 sampai 31 Juli 2026. Daftarkan diri Anda sekarang!',
            'published_at' => '2026-01-01',
            'expired_at' => '2026-08-15',
            'is_active' => true
        ]);
    }
}
