<?php

use Illuminate\Database\Seeder;

class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('species')->insert([
            ['type' => 'plesrunai'],
            ['type' => 'zoliaedziai'],
            ['type' => 'zuvys'],
        ]);
    }
}
