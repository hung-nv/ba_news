<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('advertising', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->string('name');
		    $table->text('code');
		    $table->tinyInteger('is_mobile')->default(0)->comment('0.PC 1.Mobile');
		    $table->tinyInteger('location');
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
        Schema::drop('advertising');
    }
}
