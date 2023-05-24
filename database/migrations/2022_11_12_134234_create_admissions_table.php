<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('Class');
            $table->string('Semester');
            $table->string('Subject');
            $table->string('RollNumber');
            $table->string('RegistrationNumber');
            $table->string('Session');
            $table->string('ApplicantName');
            $table->string('FatherName');
            $table->string('MotherName');
            $table->string('PermanentAddress');
            $table->string('CurrentAddress');
            $table->string('PhoneNumber');
            $table->string('Email');
            $table->string('GuardianName');
            $table->string('GuardianCurrentPhoneNumber');
            $table->string('PermanentGuardianName');
            $table->string('GuardianPermanentPhoneNumber');
            $table->string('Nationality');
            $table->string('Religion');
            $table->string('Community');
            $table->string('BloodGroup');
            $table->string('DateofBirth');
            $table->string('MarriedStatus');
            $table->enum('status', array('pending', 'active'));	
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
        Schema::dropIfExists('admissions');
    }
}
