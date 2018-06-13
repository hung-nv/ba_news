<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSetMenuToSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting', function(Blueprint $table)
        {
            $table->integer('main_menu_id')->nullable();
            $table->integer('left_menu_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting', function(Blueprint $table)
        {
            $table->dropColumn('main_menu_id');
            $table->dropColumn('left_menu_id');
        });
    }
}
