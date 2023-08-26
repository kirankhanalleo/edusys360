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
        Schema::create('employee_salary_records', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id');
            $table->double('prev_salary')->nullable();
            $table->double('current_salary')->nullable();
            $table->double('increases_salary')->nullable();
            $table->date('date_of_effect')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salary_records');
    }
};
