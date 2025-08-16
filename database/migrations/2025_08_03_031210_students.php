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
        Schema::create('students', function (Blueprint $table){
            $table->id();
            $table->string('student_id')->unique();
            $table->string('grade');
            $table->string('section');
            $table->date('enrollment_date');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('student_statuses')->onDelete('cascade');

            // $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
          

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
