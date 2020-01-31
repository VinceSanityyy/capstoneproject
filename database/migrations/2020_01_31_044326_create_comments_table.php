<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('checker_id')->unsigned();
            $table->string('comment');
            $table->timestamps();
        });

        Schema::table('comments', function($table)
        {
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
             $table->foreign('checker_id')
                    ->references('id')
                    ->on('checkers');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
