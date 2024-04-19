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
        Schema::create('add_to_cart', function (Blueprint $table) {
            $table->string('id')->unique()->primary();
            $table->string('patient_id', 200)->notNull();
            $table->string('doctor_id', 200)->notNull();
            $table->date('date_booking')->notNull();
            $table->string('time_id')->notNull();
            $table->foreign('time_id')->references('id')->on('list_time_doctor');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_to_cart');
    }
};
