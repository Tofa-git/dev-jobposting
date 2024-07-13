<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\widget;

class WidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        widget::insert([
            [
                'sequence'		=> 1,
                'description'	=> 'Menu Utama',
                'target'		=> 'partials.header',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'		=> 2,
                'description'	=> 'Footer',
                'target'		=> 'partials.footer',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],
        ]);
    }
}
