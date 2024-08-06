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
        Schema::table('delivery_schedules', function (Blueprint $table) {
            $table->smallInteger('slim_qty')->unsigned()->nullable(); 
            $table->smallInteger('round_qty')->unsigned()->nullable(); 
            $table->timestamp('exact_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_schedules', function (Blueprint $table) {
            $table->dropColumn('slim_qty');
            $table->dropColumn('round_qty');
            $table->dropColumn('exact_date');
        });
    }
};
