<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('schedule_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('remarks_id')->unsigned();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('checkers', function($table)
        {
            $table->foreign('schedule_id')
                    ->references('id')
                    ->on('schedules');
             $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
             $table->foreign('remarks_id')
                    ->references('id')
                    ->on('remarks');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkers');
    }
}
