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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('customer_id')->unsigned(); 
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->smallInteger('schedule_id')->unsigned()->nullable();
            $table->foreign('schedule_id')->references('id')->on('users')->onDelete('cascade');
            $table->smallInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('target_date')->nullable();
            $table->timestamp('next_delivery_date')->nullable();
            $table->smallInteger('price')->unsigned()->nullable(); 
            $table->smallInteger('total_qty')->unsigned(); 
            $table->enum('status', ['0', '1'])->default('1')->nullable();
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
        Schema::dropIfExists('deliveries');
    }
};
