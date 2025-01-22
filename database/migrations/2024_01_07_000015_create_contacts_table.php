<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_contact', function (Blueprint $table) {
            $table->id();
            $table->string('address', 255);
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->string('website', 100)->nullable();
            $table->string('map_url', 255)->nullable();
            $table->timestamps();
        });
        Schema::table('tbl_contact', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_contact');
    }
};
