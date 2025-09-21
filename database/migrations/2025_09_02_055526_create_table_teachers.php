<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('teachers', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->default(1);
        $table->unsignedBigInteger('employee_id');
        $table->string('teaching_subject');
        $table->string('teacher_level');
        $table->timestamps();

        // Foreign keys
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
