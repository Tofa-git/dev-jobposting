<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_data_client', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis_client')->constrained('tbl_master_data_detail');
            $table->foreignId('id_jenis_kerjasama')->constrained('tbl_master_data_detail');
            $table->string('nama', 128)->nullable();
            $table->string('nama_brand', 32)->nullable();
            $table->text('address')->nullable();
            $table->foreignId('id_type_bisnis')->constrained('tbl_master_data_detail');
            $table->foreignId('id_wilayah_administrasi')->constrained('tbl_wilayah_administrasi');
            $table->string('kode_pos', 8)->nullable();
            $table->string('logo', 64)->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('fax', 32)->nullable();
            $table->string('email', 64)->nullable();
            $table->string('website', 64)->nullable();
            $table->string('youtube', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('pic_nama', 64)->nullable();
            $table->string('pic_jabatan', 64)->nullable();
            $table->string('pic_mobile', 64)->nullable();
            $table->string('pic_email', 64)->nullable();
            $table->enum('status', ['0', '1', '2', '3'])->default('3');
            $table->foreignId('created_by')->constrained('users');
            $table->bigInteger('updated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_data_client');
    }
};
