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

        Schema::create('vacatures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('company');
            $table->string('function');
            $table->bigInteger('salary');
            $table->bigInteger('workhours');
            $table->string('location');
            $table->bigInteger('time_id');
            $table->foreign('time_id')->references('id')->on('times');
            $table->text('description');
            $table->boolean('secondary_info_needed');
            $table->string('image');
            $table->tinyInteger('status');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacatures');
    }
};
