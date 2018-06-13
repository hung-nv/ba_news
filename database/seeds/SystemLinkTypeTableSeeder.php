<?php

use Illuminate\Database\Seeder;

class SystemLinkTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_link_type')->insert([
            ['name' => 'List News', 'slug' => 'category', 'type' => 1],
            ['name' => 'List Games', 'slug' => '', 'type' => 1],
	        ['name' => 'Page Details', 'slug' => 'page', 'type' => 2],
	        ['name' => 'News Details', 'slug' => 'post', 'type' => 2],
	        ['name' => 'Game Details', 'slug' => 'game', 'type' => 2],
        ]);
    }
}
