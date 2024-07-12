<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\wilayah_administrasi;

class DataWilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared(file_get_contents(public_path('storage'.DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.'tbl_wilayah_administrasi.sql')));
        wilayah_administrasi::where('status', '3')
        	-> update(['status'=>'0']);
    }
}
