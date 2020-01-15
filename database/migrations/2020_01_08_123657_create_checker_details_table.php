<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checker_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('round_id')->unsigned();
            $table->bigInteger('violation_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('checker_details', function($table)
        {
            $table->foreign('round_id')
                    ->references('id')
                    ->on('rounds');
             $table->foreign('violation_id')
                    ->references('id')
                    ->on('violations');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checker_details');
    }
}
