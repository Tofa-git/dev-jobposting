<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\widget;
use App\Models\landing_page;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	$_widget = widget::where('status', '0')->get();
    	foreach($_widget as $widget){
        	landing_page::insert([
                'sequence'		=> $widget->sequence,
                'judul'			=> $widget->description,
                'id_widget'		=> $widget->id,
                'published_by'	=> 1,
                'published_at'	=> now(),
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ]);
    	}
    }
}
