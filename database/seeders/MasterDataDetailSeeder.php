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
                'shortname'		=> null,
                'description'	=> 'Blank',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'refid'			=> 3,
                'sequence'		=> 2,
                'shortname'		=> null,
                'description'	=> 'Berita',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],
        ]);
    }
}
