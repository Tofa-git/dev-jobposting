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
        Schema::create('tbl_user_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userid')->constrained('tbl_master_data_detail');
            $table->foreignId('menuid')->constrained('tbl_backend_menu');
            $table->enum('show', ['0', '1'])->default('0');
            $table->enum('create', ['0', '1'])->default('0');
            $table->enum('update', ['0', '1'])->default('0');
            $table->enum('suspend', ['0', '1'])->default('0');
            $table->enum('delete', ['0', '1'])->default('0');
            $table->enum('showMenu', ['0', '1'])->default('0');
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
        Schema::dropIfExists('tbl_user_role');
    }
};
