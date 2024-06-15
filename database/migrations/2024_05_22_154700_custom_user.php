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
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('updated_by')->after('remember_token')->default(0);
            $table->bigInteger('created_by')->after('remember_token')->default(0);
            $table->enum('status', ['0', '1', '2', '3'])->after('remember_token')->default('3');
            $table->longText('access_token')->after('password')->nullable();
            $table->longText('last_token')->after('password')->nullable();
            $table->string('macAddr', 24)->after('password')->nullable();
            $table->string('manufacture', 24)->after('password')->nullable();
            $table->string('sysName', 24)->after('password')->nullable();
            $table->string('sysModel', 24)->after('password')->nullable();
            $table->string('deviceId', 24)->after('password')->nullable();
            $table->unsignedBigInteger('role')->after('password');
            $table->foreign('role')->after('password')->references('id')->on('tbl_master_data_detail');
            $table->string('pictures', 64)->after('password')->nullable();
            $table->integer('related_to_employee')->after('password')->default(0);
            $table->dateTime('last_login')->after('password')->nullable();
            $table->string('last_ip', 128)->after('password')->nullable();
            $table->dateTime('current_login')->after('password')->nullable();
            $table->string('current_ip', 128)->after('password')->nullable();
            $table->text('id_div', 128)->after('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
