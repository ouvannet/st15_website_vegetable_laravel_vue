<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('tbl_sale');
            $table->foreignId('varient_id')->constrained('tbl_varient');
            $table->integer('quantity');
            $table->decimal('price_per_unit', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
        Schema::table('tbl_sale_items', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_sale_items');
    }
};
