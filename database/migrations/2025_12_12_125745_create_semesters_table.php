<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemestersTable extends Migration
{
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 20);
            $table->string('name', 50);
            $table->string('year', 10);
            $table->integer('credits');
            $table->decimal('gpa', 3, 2);
            $table->string('start_date', 20);
            $table->string('end_date', 20);
            $table->string('status', 20)->default('completed');
            $table->timestamps();

            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');

            $table->unique(['student_id', 'name']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('semesters');
    }
}