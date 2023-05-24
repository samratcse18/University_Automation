<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallTotalStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hall_total_students', function (Blueprint $table) {
            $table->id();
            $table->string('hall_name');
            $table->bigInteger('student_id')->unsigned();
            $table->enum('status', array('pending', 'active', 'residential'));
            $table->string('payment_date')->nullable();
            $table->string('room')->nullable();
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hall_total_students');
    }
}
