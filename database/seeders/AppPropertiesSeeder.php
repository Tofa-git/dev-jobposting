<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\app_properties;

class AppPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	app_properties::create([
            'name'              => 'Jobposting',
            'address'           => 'Jl. Gas alam No.65A Kel. Curug, Kec. Cimanggis Depok 16451',
            'phone'             => '+62-21-3903963',
            'fax'               => '+62-21-3903922',
            'email'             => 'admin@runlapan.com',
            'website'           => 'https://runlapan.com',
            'icon_text_1'       => 'Jobposting',
            'icon_text_2'       => 'Run8 Management',
            'copyright'         => '&copy; PT. Radar Utama Nusantara Lapan',
            'api_host'          => 'https://valeriealvaro.link-webid.com/api',
            'api_secret'        => 'JSoVuHZ6GDPyiSi+XUxTmA==',
            'frontend_website'  => 1,
            'status'            => '0',
            'created_by'        => 1,
        ]);
    }
}
