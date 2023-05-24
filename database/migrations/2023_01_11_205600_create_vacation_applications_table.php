<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacationApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacation_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->string('reason_title');
            $table->date('vacation_start');
            $table->date('vacation_end');
            $table->integer('vacation_days');
            $table->string('application_status');
            $table->integer('approve_days')->nullable();
            $table->integer('helper_id');
            $table->string('dept_name');
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
        Schema::dropIfExists('vacation_applications');
    }
}
