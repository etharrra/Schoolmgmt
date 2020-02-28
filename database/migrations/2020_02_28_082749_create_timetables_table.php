<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('time_start');
            $table->string('time_finish');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->string('day');
            $table->timestamps();

            $table->foreign('class_id')
                  ->references('id')->on('classes')
                  ->onDelete('cascade');

            $table->foreign('subject_id')
                  ->references('id')->on('subjects')
                  ->onDelete('cascade');      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetables');
    }
}