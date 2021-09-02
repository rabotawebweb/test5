<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecksplanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checksplans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('object_id')->unsigned();
			$table->foreign('object_id')->references('id')->on('objectslist');
			$table->bigInteger('control_id')->unsigned();
			$table->foreign('control_id')->references('id')->on('controlist');
            $table->string('plan');
			$table->date('checks_from');
			$table->date('checks_to');
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
        Schema::dropIfExists('checksplans');
    }
}
