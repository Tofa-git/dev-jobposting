<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_image_slider', function (Blueprint $table) {
            $table->id();
            $table->integer('sequence')->default(0);
            $table->integer('source')->default(0);
            $table->string('file_background', 64)->nullable();
            $table->string('title', 255);
            $table->text('content')->nullable();
            $table->bigInteger('published_by')->default(0);
            $table->dateTime('published_at')->nullable();
            $table->enum('status', ['0', '1', '2', '3'])->default('3');
            $table->foreignId('created_by')->constrained('users');
            $table->bigInteger('updated_by')->default(0);
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
        Schema::dropIfExists('tbl_image_slider');
    }
}
