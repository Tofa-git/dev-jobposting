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
        Schema::create('tbl_log_activities', function (Blueprint $table) {
            $table->id();
            $table->string('ip4', 128)->nullable();
            $table->string('module', 64)->nullable();
            $table->string('title', 64)->nullable();
            $table->string('description', 255)->nullable();
            $table->text('url')->nullable();
            $table->string('method', 255)->nullable();
            $table->string('device', 32)->nullable();
            $table->string('platform', 32)->nullable();
            $table->string('agent', 255)->nullable();
            $table->string('browser', 32)->nullable();
            $table->string('browser_version', 32)->nullable();
            $table->float('latitude')->default(0.00);
            $table->float('lontitude')->default(0.00);
            $table->enum('log_type', ['0', '1', '2'])->default('2');
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
        Schema::dropIfExists('tbl_log_activities');
    }
};
