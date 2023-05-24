<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallCircularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hall_circulars', function (Blueprint $table) {
            $table->id();
            $table->string('dept');
            $table->string('circular');
            $table->string('type');
            $table->string('prefix');
            $table->string('suffix');
            $table->string('last_date');
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
        Schema::dropIfExists('hall_circulars');
    }
}
