<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records_results', function (Blueprint $table) {
            $table->id();
            $table->float('weight');
            $table->integer('quantity');
            $table->unsignedBigInteger('exercise_id');
            $table->timestamps();

            $table->foreign('exercise_id')->references('id')->on('records_exercises');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records_results');
    }
}
