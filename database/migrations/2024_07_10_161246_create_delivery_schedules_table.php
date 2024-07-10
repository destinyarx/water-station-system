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
        Schema::create('delivery_schedules', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('customer_id')->unsigned(); 
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade'); 
            $table->enum('status', ['0', '1'])->default('1');
            $table->string('notes', 100)->nullable();
            $table->smallInteger('product_qty')->unsigned(); 
            $table->string('frequency_type', 20);
            $table->string('frequency_value', 20);
            $table->smallInteger('created_by')->unsigned(); 
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade'); 
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
        Schema::dropIfExists('delivery_schedules');
    }
};
