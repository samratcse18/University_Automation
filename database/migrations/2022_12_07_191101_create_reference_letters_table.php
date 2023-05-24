<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_letters', function (Blueprint $table) {
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
            $table->string('country');
            $table->string('letter_opportunity');
            $table->string('receiver_title');
            $table->string('organization_name');
            $table->text('organization_address');
            $table->string('ssc_gpa');
            $table->string('hsc_gpa');
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
        Schema::dropIfExists('reference_letters');
    }
}
