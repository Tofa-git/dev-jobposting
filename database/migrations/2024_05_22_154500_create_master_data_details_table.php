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
        Schema::create('tbl_master_data_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('refid');
            $table->foreign('refid')->references('id')->on('tbl_master_data');
            $table->integer('sequence')->default(0);
            $table->string('shortname', 16)->nullable();
            $table->string('description', 255)->nullable();
            $table->enum('status', ['0', '1', '2', '3'])->default('3');
            $table->bigInteger('created_by')->default(0);
            $table->bigInteger('updated_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_master_data_detail');
    }
};
