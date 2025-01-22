<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('full_name', 100)->nullable();
            $table->string('gender', 50)->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->foreignId('role_id')->nullable()->constrained('tbl_role');
            $table->timestamps();
        });
        Schema::table('tbl_users', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_users');
    }
};
