<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject_name');
            $table->integer('units');
            $table->string('type');
            $table->bigInteger('department_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::table('subjects', function($table)
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
        Schema::dropIfExists('subjects');
    }
}
