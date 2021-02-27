<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChampionshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('championships', function (Blueprint $table) {
            $table->id();
            $table->integer('day');
            $table->unsignedBigInteger('first_team');
            $table->unsignedBigInteger('second_team');
            $table->integer('first_team_award');
            $table->integer('second_team_award');
            $table->foreign('first_team')->references('id')->on('teams');
            $table->foreign('second_team')->references('id')->on('teams');
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
        Schema::dropIfExists('championships');
    }
}
