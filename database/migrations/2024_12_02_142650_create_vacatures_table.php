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
            $table->unsignedBigInteger('company_id'); // Use unsignedBigInteger for foreign keys
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade'); // Add onDelete('cascade') here
            $table->string('function');
            $table->bigInteger('salary');
            $table->bigInteger('workhours');
            $table->string('location')->nullable();
            $table->boolean('time_id');
            $table->text('description');
            $table->boolean('secondary_info_needed');
            $table->string('image')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
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
