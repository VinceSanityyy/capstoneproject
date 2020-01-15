<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('checker_id')->unsigned();
            $table->bigInteger('round_no');
            $table->bigInteger('remarks_id')->unsigned();
            $table->string('status');
            $table->string('time_check');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('rounds', function($table)
        {
            $table->foreign('checker_id')
                    ->references('id')
                    ->on('checkers');
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
        Schema::dropIfExists('rounds');
    }
}
