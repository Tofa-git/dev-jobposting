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
        Schema::create('tbl_landing_page', function (Blueprint $table) {
            $table->id();
            $table->integer('sequence')->default(0);
            $table->string('judul', 255);
            $table->bigInteger('id_widget')->default(0);
            $table->longText('content')->nullable();
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
        Schema::dropIfExists('tbl_landing_page');
    }
};
