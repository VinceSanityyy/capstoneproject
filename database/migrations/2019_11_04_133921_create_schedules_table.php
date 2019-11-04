<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('time_from');
            $table->string('time_to');
            $table->string('day');
            $table->bigInteger('subject_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('room_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::table('schedules', function($table)
        {
            $table->foreign('subject_id')
                    ->references('id')
                    ->on('subjects');
           $table->foreign('teacher_id')
                    ->references('id')
                    ->on('teachers');
           $table->foreign('room_id')
                    ->references('id')
                    ->on('rooms');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
