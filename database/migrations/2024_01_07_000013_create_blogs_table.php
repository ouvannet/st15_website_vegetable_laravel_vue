<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_blog', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('content');
            $table->foreignId('create_by')->constrained('tbl_users');
            $table->string('featured_image', 255)->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
        Schema::table('tbl_blog', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_blog');
    }
};
