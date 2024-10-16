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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_activated')->default(false);
            $table->string('email', 50)->nullable();
            $table->string('socmed_link', 100)->nullable();
            $table->smallInteger('contact_number')->unsigned()->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_activated');
            $table->dropColumn('email');
            $table->dropColumn('socmed_link');
            $table->dropColumn('contact_number');
        });
    }
};
