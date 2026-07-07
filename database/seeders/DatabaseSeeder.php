<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        if (!\App\Models\FormTemplate::where('nama', 'Pemeliharaan CCTV')->exists()) {
            \App\Models\FormTemplate::create([
                'nama' => 'Pemeliharaan CCTV',
                'kategori' => 'Umum',
                'route_name' => 'form-cctv.index',
                'no_dokumen' => 'FR.SM/TI/015.013/10-2020',
                'tanggal_dokumen' => '12 Oktober 2020',
                'versi_dokumen' => '002-2020',
            ]);
        }

        if (!\App\Models\FormTemplate::where('nama', 'Permohonan Pencabutan Hak Akses')->exists()) {
            \App\Models\FormTemplate::create([
                'nama' => 'Permohonan Pencabutan Hak Akses',
                'kategori' => 'Public',
                'route_name' => 'form-pencabutan-hak-akses.index',
                'no_dokumen' => 'FR.SM/TI/013.004/10-2020',
                'tanggal_dokumen' => '12 Oktober 2020',
                'versi_dokumen' => '002-2020',
            ]);
        }
    }
}
