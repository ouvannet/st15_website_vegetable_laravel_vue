<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('tbl_categorys');
            $table->foreignId('brand_id')->nullable()->constrained('tbl_brand');
            $table->foreignId('base_unit_id')->nullable()->constrained('tbl_unit');
            $table->decimal('base_price', 10, 2);
            $table->integer('stock_quantity')->default(0);
            $table->string('image_url', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::table('tbl_products', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_products');
    }
};
