<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSummariesTable extends Migration
{
    public function up()
    {
        Schema::create('student_summaries', function (Blueprint $table) {
            $table->string('student_id', 20)->primary();
            $table->decimal('cgpa', 3, 2);
            $table->integer('total_credits');
            $table->integer('total_courses');
            $table->integer('total_semesters');
            $table->timestamps();

            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_summaries');
    }
}