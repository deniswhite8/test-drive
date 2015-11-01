<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

/**
 * Model generation seeder
 */
class GenerationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auto_generations')->delete();
        $csv = Reader::createFromPath(__DIR__ . '/data/generations.csv');
        DB::table('auto_generations')->insert($csv->fetchAssoc());
    }
}
