<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\master_data_detail;

class MasterDataDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        master_data_detail::insert([
            [
                'refid'			=> 1,
                'sequence'		=> 1,
                'shortname'		=> null,
                'description'	=> 'Developer',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'			=> 1,
                'sequence'		=> 2,
                'shortname'		=> null,
                'description'	=> 'Super Administrator',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'			=> 1,
                'sequence'		=> 3,
                'shortname'		=> null,
                'description'	=> 'Administrator',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'			=> 2,
                'sequence'		=> 1,
                'shortname'		=> null,
                'description'	=> 'Menu Title',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'			=> 2,
                'sequence'		=> 2,
                'shortname'		=> null,
                'description'	=> 'Menu',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'			=> 2,
                'sequence'		=> 3,
                'shortname'		=> null,
                'description'	=> 'Separator',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'			=> 3,
                'sequence'		=> 1,
                'shortname'		=> '/halaman/management',
                'description'	=> 'Management',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'			=> 3,
                'sequence'		=> 2,
                'shortname'		=> '/halaman/berita',
                'description'	=> 'Berita',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 3,
                'sequence'      => 3,
                'shortname'     => '/halaman/bisnis',
                'description'   => 'Bisnis',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 3,
                'sequence'      => 4,
                'shortname'     => '/halaman/team',
                'description'   => 'Team',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 3,
                'sequence'      => 5,
                'shortname'     => '/halaman/project',
                'description'   => 'Project',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 15,
                'sequence'      => 1,
                'shortname'     => null,
                'description'   => 'Politik',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 15,
                'sequence'      => 2,
                'shortname'     => null,
                'description'   => 'Kesehatan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 15,
                'sequence'      => 3,
                'shortname'     => null,
                'description'   => 'Teknologi',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 15,
                'sequence'      => 4,
                'shortname'     => null,
                'description'   => 'Pertanian',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 15,
                'sequence'      => 5,
                'shortname'     => null,
                'description'   => 'Kriminal',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 16,
                'sequence'      => 1,
                'shortname'     => null,
                'description'   => 'Berita Daerah',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 16,
                'sequence'      => 2,
                'shortname'     => null,
                'description'   => 'Berita Nasional',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 15,
                'sequence'      => 3,
                'shortname'     => null,
                'description'   => 'Berita Internasional',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 17,
                'sequence'      => 1,
                'shortname'     => null,
                'description'   => 'Slider',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 17,
                'sequence'      => 2,
                'shortname'     => null,
                'description'   => 'List',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 17,
                'sequence'      => 3,
                'shortname'     => null,
                'description'   => 'Blank Widget',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 18,
                'sequence'      => 1,
                'shortname'     => null,
                'description'   => 'Mitra Perusahaan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 18,
                'sequence'      => 2,
                'shortname'     => null,
                'description'   => 'Mitra Perorangan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 18,
                'sequence'      => 3,
                'shortname'     => null,
                'description'   => 'Klien Perusahaan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 18,
                'sequence'      => 4,
                'shortname'     => null,
                'description'   => 'Klien Perorangan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 19,
                'sequence'      => 1,
                'shortname'     => null,
                'description'   => 'Pasang Lowongan Kerja',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 19,
                'sequence'      => 2,
                'shortname'     => null,
                'description'   => 'Cari Karyawan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 19,
                'sequence'      => 3,
                'shortname'     => null,
                'description'   => 'Oursourching',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 19,
                'sequence'      => 4,
                'shortname'     => null,
                'description'   => 'Jasa Alih Daya',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 10,
                'sequence'      => 1,
                'shortname'     => null,
                'description'   => 'Teknologi dan Informasi',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 10,
                'sequence'      => 2,
                'shortname'     => null,
                'description'   => 'Industri',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 10,
                'sequence'      => 3,
                'shortname'     => null,
                'description'   => 'Perdagangan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 10,
                'sequence'      => 4,
                'shortname'     => null,
                'description'   => 'Pertanian',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 10,
                'sequence'      => 5,
                'shortname'     => null,
                'description'   => 'Perikanan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 10,
                'sequence'      => 6,
                'shortname'     => null,
                'description'   => 'Peternakan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 10,
                'sequence'      => 7,
                'shortname'     => null,
                'description'   => 'Pertambangan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 10,
                'sequence'      => 8,
                'shortname'     => null,
                'description'   => 'Transportasi',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 10,
                'sequence'      => 9,
                'shortname'     => null,
                'description'   => 'Pariwisata',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 10,
                'sequence'      => 10,
                'shortname'     => null,
                'description'   => 'Jasa',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 10,
                'sequence'      => 11,
                'shortname'     => null,
                'description'   => 'Perdagangan Umum',
                'status'        => '0',
                'created_by'    => 11,
                'created_at'    => now(),
            ],[
                'refid'         => 10,
                'sequence'      => 12,
                'shortname'     => null,
                'description'   => 'Usaha Lainnya',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 3,
                'sequence'      => 6,
                'shortname'     => '/halaman/kenapa-pilih-run8',
                'description'   => 'Project',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'         => 1,
                'sequence'      => 4,
                'shortname'     => null,
                'description'   => 'General Account',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ]
        ]);
    }
}
