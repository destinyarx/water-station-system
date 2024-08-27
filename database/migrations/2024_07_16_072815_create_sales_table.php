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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('customer_id')->unsigned()->nullable(); 
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->smallInteger('deliver_history_id')->unsigned()->nullable(); 
            $table->foreign('deliver_history_id')->references('id')->on('delivery_history')->onDelete('cascade');
            $table->smallInteger('created_by')->unsigned(); 
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->index('customer_id');
            $table->index('deliver_history_id');
            $table->index('created_by');
            $table->smallInteger('total')->unsigned(); 
            $table->smallInteger('qty')->unsigned(); 
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
        Schema::dropIfExists('sales');
    }
};
