<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediumCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medium_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('std_id');
            $table->string('dept_name');
            $table->string('fprogram');
            $table->string('cprogram');
            $table->string('full_name');
            $table->string('gender');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('vill_area');
            $table->string('post_office');
            $table->string('thana');
            $table->string('district');
            $table->string('academic_session');
            $table->integer('status');
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
        Schema::dropIfExists('medium_certificates');
    }
}
