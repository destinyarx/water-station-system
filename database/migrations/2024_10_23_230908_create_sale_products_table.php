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
        Schema::create('sale_products', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('sales_id')->unsigned();
            $table->foreign('sales_id')->references('id')->on('sales');
            $table->smallInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->smallInteger('quantity')->unsigned();
            $table->smallInteger('sale_price')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_products');
    }
};
