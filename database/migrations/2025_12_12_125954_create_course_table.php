<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourseTable extends Migration
{
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade');
            $table->string('code', 20);
            $table->string('title', 200);
            $table->integer('credits');
            $table->integer('marks')->nullable();
            $table->string('grade', 5)->nullable();
            $table->decimal('grade_point', 3, 2)->nullable();
            $table->string('status', 20)->default('passed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course');
    }
}