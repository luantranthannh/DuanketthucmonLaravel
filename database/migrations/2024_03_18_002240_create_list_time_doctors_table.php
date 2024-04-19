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
        Schema::create('list_time_doctor', function (Blueprint $table) {
            $table->string('id', 200)->unique()->primary();
            $table->index('id', 'idx_list_time_doctor_id');
            $table->time('time_start')->notNull();
            $table->time('time_end')->notNull();
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_time_doctor');
    }
};
