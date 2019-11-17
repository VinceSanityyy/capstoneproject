<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('image')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('gender');
            $table->string('birthday');
            $table->integer('age');
            $table->string('type');
            $table->bigInteger('department_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::table('teachers', function($table)
        {
            $table->foreign('department_id')
                    ->references('id')
                    ->on('departments');
        });

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
