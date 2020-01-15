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
           
            $table->bigInteger('subject_code_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('room_id')->unsigned();
            $table->string('start_time');
            $table->string('end_time');
            $table->string('school_year');
            $table->string('semester');
            $table->string('term');
            $table->string('day');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('schedules', function($table)
        {
            $table->foreign('subject_code_id')
                    ->references('id')
                    ->on('subject_codes');
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
