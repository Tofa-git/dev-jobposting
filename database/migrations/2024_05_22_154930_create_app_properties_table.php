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
        Schema::create('tbl_app_properties', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->nullable();
            $table->text('address', 64)->nullable();
            $table->string('logo', 64)->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('mobile', 32)->nullable();
            $table->string('fax', 32)->nullable();
            $table->string('email', 64)->nullable();
            $table->string('website', 64)->nullable();
            $table->enum('logo_type', ['0', '1', '2', '3'])->default('3');
            $table->string('icon_logo', 64)->nullable();
            $table->string('icon_text_1', 64)->nullable();
            $table->string('icon_text_2', 64)->nullable();
            $table->text('copyright', 64)->nullable();
            $table->text('youtube')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('linkedin')->nullable();
            $table->string('mail_driver', 8)->nullable();
            $table->string('mail_host', 32)->nullable();
            $table->string('mail_port', 8)->nullable();
            $table->string('mail_username', 64)->nullable();
            $table->string('mail_password', 64)->nullable();
            $table->string('mail_encryption', 8)->nullable();
            $table->string('wa_number', 32)->nullable();
            $table->string('wa_api_key', 64)->nullable();
            $table->text('api_host')->nullable();
            $table->text('api_secret')->nullable();
            $table->boolean('frontend_website')->default(0);
            $table->enum('status', ['0', '1', '2', '3'])->default('3');
            $table->foreignId('created_by')->constrained('users');
            $table->bigInteger('updated_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_app_properties');
    }
};
