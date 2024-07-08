<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasiPentingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_informasi_penting', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis')->constrained('tbl_master_data_detail');
            $table->foreignId('id_kategori')->constrained('tbl_master_data_detail');
            $table->date('tanggal')->nullable();
            $table->string('lokasi', 128)->nullable();
            $table->string('title', 255);
            $table->text('foto_utama')->nullable();
            $table->string('keterangan_foto', 128)->nullable();
            $table->text('content')->nullable();
            $table->string('meta_title', 128)->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->bigInteger('published_by')->default(0);
            $table->dateTime('published_at')->nullable();
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
        Schema::dropIfExists('tbl_informasi_penting');
    }
}
