<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutineInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routine_infos', function (Blueprint $table) {
            $table->id();
            $table->string('dept_name');
            $table->integer('student_type');
            $table->string('class_name');
            $table->integer('program_id');
            $table->string('session_year');
            $table->string('semester');
            $table->string('semester_duration_id');
            $table->integer('teacher_id');
            $table->integer('course_id');
            $table->integer('course_credit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routine_infos');
    }
}
