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
        Schema::disableForeignKeyConstraints();

        Schema::create('demand_vacture', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('demand_id');
            $table->foreign('demand_id')->references('id')->on('demands');
            $table->bigInteger('vacature_id');
            $table->foreign('vacature_id')->references('id')->on('vacatures');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demand_vacture');
    }
};
