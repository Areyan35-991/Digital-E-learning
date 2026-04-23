<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_course_teacher_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTeacherTable extends Migration
{
    public function up()
    {
        Schema::create('course_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade'); // assuming teachers are users
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['course_id', 'instructor_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_teacher');
    }
}