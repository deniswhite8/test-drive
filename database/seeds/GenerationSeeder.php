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

        $data = Reader::createFromPath(__DIR__ . '/data/generations.csv')->fetchAssoc();
        foreach ($data as &$row) {
            if (!$row['end_year_production']) {
                $row['end_year_production'] = null;
            }
        }

        DB::table('auto_generations')->insert($data);
    }
}
