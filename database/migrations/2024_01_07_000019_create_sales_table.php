<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_sale', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('tbl_users');
            $table->decimal('total_amount', 10, 2);
            $table->foreignId('payment_method_id')->constrained('tbl_payment_method');
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');
            $table->enum('order_status', ['processing', 'shipped', 'delivered', 'cancelled'])->default('processing');
            $table->text('shipping_address');
            $table->timestamps();
        });
        Schema::table('tbl_sale', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_sale');
    }
};
