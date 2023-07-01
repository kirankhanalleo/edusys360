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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('reg_id');
            $table->string('name');
            $table->date('dob');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('email');
            $table->string('address');
            $table->string('contact');
            $table->string('local_guardian');
            $table->string('local_guardian_relationship');
            $table->string('local_guardian_contact');
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
        Schema::dropIfExists('students');
    }
};
