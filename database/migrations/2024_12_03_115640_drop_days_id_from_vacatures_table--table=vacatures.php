<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
/**
* Run the migrations.
*/
public function up(): void
{
Schema::disableForeignKeyConstraints();

// Create a new table without the 'days_id' column
Schema::create('new_vacatures', function (Blueprint $table) {
$table->id();
$table->bigInteger('company_id');
$table->foreign('company_id')->references('id')->on('companies');
$table->string('function');
$table->bigInteger('salary');
$table->bigInteger('workhours');
    $table->integer('place');
$table->string('location')->nullable();
$table->boolean('time_id');
$table->text('description');
$table->boolean('secondary_info_needed');
$table->string('image')->nullable();
$table->tinyInteger('status');
$table->timestamps();
});

// Copy data from the old table to the new table
DB::table('new_vacatures')->insert(
DB::table('vacatures')->select('id', 'company_id', 'function', 'salary', 'workhours','place', 'location', 'time_id', 'description', 'secondary_info_needed', 'image', 'status', 'created_at', 'updated_at')->get()->toArray()
);

// Drop the old table
Schema::dropIfExists('vacatures');

// Rename the new table to the old table name
Schema::rename('new_vacatures', 'vacatures');

Schema::enableForeignKeyConstraints();
}

/**
* Reverse the migrations.
*/
public function down(): void
{
// This method should restore the original state if needed
}
};
