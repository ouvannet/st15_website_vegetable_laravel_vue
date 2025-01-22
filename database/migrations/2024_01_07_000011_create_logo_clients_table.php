<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_logo_client', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('logo_url', 255)->nullable();
            $table->string('website_url', 255)->nullable();
            $table->timestamps();
        });
        Schema::table('tbl_logo_client', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_logo_client');
    }
};
