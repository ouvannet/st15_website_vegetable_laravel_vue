<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_varient', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('tbl_products');
            $table->foreignId('unit_id')->constrained('tbl_unit');
            $table->decimal('price', 10, 2);
            $table->decimal('quantity_in_base_unit', 10, 2);
            $table->timestamps();
        });
        Schema::table('tbl_varient', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_varient');
    }
};
