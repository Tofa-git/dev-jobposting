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
        Schema::create('tbl_data_file', function (Blueprint $table) {
            $table->id();
            $table->string('type', 32)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('filename', 128)->nullable();
            $table->string('extension', 8)->nullable();
            $table->bigInteger('size')->default(0.00);
            $table->string('description')->nullable();
            $table->string('alt')->nullable();
            $table->bigInteger('owner')->default(0);
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
        Schema::dropIfExists('tbl_data_file');
    }
};
