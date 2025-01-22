<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('tbl_sale');
            $table->decimal('amount', 10, 2);
            $table->foreignId('payment_method_id')->constrained('tbl_payment_method');
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamp('payment_date')->useCurrent();
            $table->timestamps();
        });
        Schema::table('tbl_payment', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_payment');
    }
};
