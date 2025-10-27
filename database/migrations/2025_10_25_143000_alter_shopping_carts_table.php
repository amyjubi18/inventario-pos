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
        Schema::table('shopping_carts', function (Blueprint $table) {
            $table->dropColumn(['voucher_type', 'serie', 'correlative', 'date', 'observation', 'change']);
            $table->unsignedBigInteger('quote_id')->nullable()->after('customer_id');
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shopping_carts', function (Blueprint $table) {
            $table->string('voucher_type');
            $table->string('serie');
            $table->integer('correlative');
            $table->date('date');
            $table->text('observation')->nullable();
            $table->decimal('change', 10, 2)->nullable();
            $table->dropForeign(['quote_id']);
            $table->dropColumn('quote_id');
        });
    }
};
