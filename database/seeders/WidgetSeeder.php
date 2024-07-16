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
                'sequence'      => 2,
                'description'   => 'Image Slider',
                'target'        => 'widget.image slider',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 3,
                'description'   => 'Pencarian',
                'target'        => 'widget.pencarian',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 4,
                'description'   => 'Kenapa Pilih RUN8',
                'target'        => 'widget.kenapa pilih run8',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 5,
                'description'   => 'Peluang Karir',
                'target'        => 'widget.peluang karir',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 6,
                'description'   => 'Visi dan Misi',
                'target'        => 'widget.visi dan misi',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 7,
                'description'   => 'Jumlah Karyawan',
                'target'        => 'widget.jumlah karyawan',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 8,
                'description'   => 'Bisnis RUN8',
                'target'        => 'widget.bisnis run8',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 9,
                'description'   => 'IDE dan CEO',
                'target'        => 'widget.ide dan ceo',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 10,
                'description'   => 'Klien Alih Daya',
                'target'        => 'widget.klien alih daya',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 11,
                'description'   => 'Mitra',
                'target'        => 'widget.mitra',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 12,
                'description'   => 'Testimoni',
                'target'        => 'widget.testimoni',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 13,
                'description'   => 'Berita',
                'target'        => 'widget.berita',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 14,
                'description'   => 'Gallery',
                'target'        => 'widget.gallery',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'      => 15,
                'description'   => 'FAQ',
                'target'        => 'widget.faq',
                'status'        => '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ],[
                'sequence'		=> 16,
                'description'	=> 'Footer',
                'target'		=> 'partials.footer',
                'status'		=> '0',
                'created_by'    => 1,
                'created_at'    => now(),
            ]
        ]);
    }
}
