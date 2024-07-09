<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\frontend_menu;

class FrontendMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	frontend_menu::insert([
			[
	    		'refid'			=> 0,
    			'menu_type'		=> 5,
    			'sequence'		=> 1,
    			'icon'			=> null,
	    		'caption'		=> 'Home',
    			'target_url'    => '/',
                'target_slug'	=> null,
        		'published_by'  => 1,
        		'published_at'  => now(),
	    		'status'		=> '0',
    			'created_by'    => 1,
    			'created_at'    => now()
			],[
                'refid'         => 0,
                'menu_type'     => 5,
                'sequence'      => 2,
                'icon'          => null,
                'caption'       => 'Login',
                'target_url'    => '/',
                'target_slug'   => 'login',
                'published_by'  => 1,
                'published_at'  => now(),
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now()
            ]
        ]);
    }
}
