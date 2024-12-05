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
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyInteger('monday')->default(0);
            $table->tinyInteger('tuesday')->default(0);
            $table->tinyInteger('wednesday')->default(0);
            $table->tinyInteger('thursday')->default(0);
            $table->tinyInteger('friday')->default(0);
            $table->tinyInteger('saturday')->default(0);
            $table->tinyInteger('sunday')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};
