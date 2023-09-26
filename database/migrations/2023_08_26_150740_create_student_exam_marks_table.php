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
        Schema::create('student_exam_marks', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('reg_id')->nullable();
            $table->integer('year_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('exam_id')->nullable();
            $table->double('marks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exam_marks');
    }
};