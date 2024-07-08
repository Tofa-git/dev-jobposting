<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHalamanWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_halaman_website', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_layout')->default(0);
            $table->string('title', 255);
            $table->string('url', 255);
            $table->string('gambar_utama', 128)->nullable();
            $table->string('meta_title', 128)->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->longText('content')->nullable();
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
        Schema::dropIfExists('tbl_halaman_website');
    }
}
