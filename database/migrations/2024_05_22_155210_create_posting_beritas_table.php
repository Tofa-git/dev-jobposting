<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostingBeritasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_berita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis')->constrained('tbl_master_data_detail');
            $table->foreignId('id_kategori')->constrained('tbl_master_data_detail');
            $table->string('title', 255);
            $table->string('slug', 255)->nullable();
            $table->text('foto_utama')->nullable();
            $table->string('keterangan_foto', 128)->nullable();
            $table->text('content')->nullable();
            $table->enum('sebagai_slider', ['0', '1'])->default('0');
            $table->bigInteger('published_by')->default(0);
            $table->dateTime('published_at')->nullable();
            $table->bigInteger('dibaca')->default(0);
            $table->bigInteger('dishare')->default(0);
            $table->enum('status', ['0', '1', '2', '3'])->default('3');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_berita');
    }
}
