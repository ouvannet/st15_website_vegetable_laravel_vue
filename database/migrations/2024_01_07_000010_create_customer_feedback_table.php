<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_customer_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('tbl_users');
            $table->text('comment');
            $table->timestamps();
        });
        Schema::table('tbl_customer_feedback', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_customer_feedback');
    }
};
