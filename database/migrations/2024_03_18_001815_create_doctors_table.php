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
        Schema::create('doctors', function (Blueprint $table) {
            $table->string('id', 200)->unique()->primary();
            $table->string('user_id', 200)->notNull();
            $table->string('description', 200)->nullable();
            $table->enum('specialization', ['Psycho doctor', 'Psychologists', 'Neurologist'])
                ->nullable()
                ->default('Psycho doctor');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }
  
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};