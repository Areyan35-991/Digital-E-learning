<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->decimal('quiz_marks', 5, 2)->default(0);
            $table->decimal('assignment_marks', 5, 2)->default(0);
            $table->decimal('midterm_marks', 5, 2)->default(0);
            $table->decimal('final_marks', 5, 2)->default(0);
            $table->decimal('total_marks', 5, 2)->default(0);
            $table->string('final_grade', 2)->nullable();
            $table->decimal('grade_point', 3, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['enrollment_id', 'course_id']);
            $table->index(['student_id', 'course_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
};