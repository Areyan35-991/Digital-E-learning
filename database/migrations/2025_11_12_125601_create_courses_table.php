<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('instructor');
            $table->string('category');
            $table->string('semester');
            $table->string('language')->default('English');
            $table->string('skill_level')->default('Beginner');
            $table->integer('lessons')->default(0);
            $table->integer('duration_weeks')->default(0);
            $table->integer('enrolled_count')->default(0);
            $table->decimal('price', 8, 2)->default(0);
            $table->string('image')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};