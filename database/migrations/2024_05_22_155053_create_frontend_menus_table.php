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
        Schema::create('tbl_frontend_menu', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('refid')->default(0);
            $table->foreignId('menu_type')->constrained('tbl_master_data_detail');
            $table->integer('sequence')->default(0);
            $table->string('icon', 32)->nullable();
            $table->string('caption', 128)->nullable();
            $table->string('target_url', 94)->nullable();
            $table->string('target_slug', 255)->nullable();
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
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_frontend_menu');
    }
};
