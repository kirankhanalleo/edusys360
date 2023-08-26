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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('name');
            $table->integer('degn_id');
            $table->date('dob');
            $table->date('joined_date');
            $table->double('salary');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('email');
            $table->string('address');
            $table->string('contact');
            $table->string('religion');
            $table->string('caste');
            $table->string('blood_group');
            $table->string('image_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
