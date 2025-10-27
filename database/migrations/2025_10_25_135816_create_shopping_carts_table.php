<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->string('voucher_type');
            $table->string('serie');
            $table->integer('correlative');
            $table->date('date');
            $table->unsignedBigInteger('customer_id');
            $table->decimal('total', 10, 2);
            $table->text('observation')->nullable();
            $table->enum('payment_method', ['efectivo', 'tarjeta', 'cheque', 'transferencia']);
            $table->decimal('amount_paid', 10, 2)->nullable();
            $table->decimal('change', 10, 2)->nullable();
            $table->json('products');
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_carts');
    }
};
