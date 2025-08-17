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
        $table->unsignedBigInteger('user_id')->default(1);
        $table->string('student_id')->unique();
        $table->string('grade');               // required
        $table->string('section');             // required
        $table->date('enrollment_date');       // required
        $table->unsignedBigInteger('status_id');
        $table->timestamps();

        // Foreign keys
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('status_id')->references('id')->on('student_statuses')->onDelete('cascade');
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
