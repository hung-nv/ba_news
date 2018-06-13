<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTelephoneToSettingTable extends Migration
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
            $table->text('google_map')->nullable()->change();
        });

        Schema::table('setting', function(Blueprint $table)
        {
            $table->string('telephone', 100)->nullable();
            $table->string('site_heading')->nullable();
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
            $table->dropColumn('telephone');
            $table->dropColumn('site_heading');
        });
    }
}
