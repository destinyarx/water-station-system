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
        Schema::create('delivery_history', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('customer_id')->unsigned(); 
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->smallInteger('schedule_id')->unsigned(); 
            $table->foreign('schedule_id')->references('id')->on('delivery_schedules')->onDelete('cascade'); 
            $table->enum('status', ['success', 'failed', 'stop']);
            $table->string('notes', 35)->nullable();
            $table->smallInteger('created_by')->unsigned(); 
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade'); 
            $table->index('customer_id');
            $table->index('schedule_id');
            $table->index('created_by');
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
        Schema::dropIfExists('delivery_history');
    }
};
