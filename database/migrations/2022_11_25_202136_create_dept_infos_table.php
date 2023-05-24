<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeptInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dept_infos', function (Blueprint $table) {
            $table->id();
            $table->string('dept_name');
            $table->string('dept_nameB');
            $table->string('dept_nameE');
            $table->string('dept_head_nameB');
            $table->string('dept_head_nameE');
            $table->string('dept_head_signature');
            $table->string('dept_head');
            $table->string('dept_headB');
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
        Schema::dropIfExists('dept_infos');
    }
}
