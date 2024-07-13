<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\master_data;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        master_data::insert([
            [
                'type'			=> '0',
                'description'	=> 'Account Type',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Menu Type',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Jenis Layout',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Pendidikan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Jenis Kelamin',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Agama',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Status Pernikahan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Status Karyawan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Kendaraan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Type Bisnis',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Bidang Pekerjaan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Posisi Dibutuhkan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Perhitungan Gaji Pokok',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Vaksin Covid 19',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Kategori Berita',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Jenis Berita',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Widget',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Jenis Klien',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'type'          => '0',
                'description'   => 'Jenis Kerjasama',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ]
        ]);
    }
}
