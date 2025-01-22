<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_permission_role', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained('tbl_role')->onDelete('cascade');
            $table->foreignId('permission_id')->constrained('tbl_permission')->onDelete('cascade');
            $table->primary(['role_id', 'permission_id']);
            $table->timestamps();
        });
        Schema::table('tbl_permission_role', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_permission_role');
    }
};
