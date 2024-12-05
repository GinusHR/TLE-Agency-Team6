<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDaysToVacaturesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vacatures', function (Blueprint $table) {
            $table->json('days')->nullable(); // JSON column for days of the week
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vacatures', function (Blueprint $table) {
            $table->dropColumn('days'); // Drop the column in the down method
        });
    }
}
