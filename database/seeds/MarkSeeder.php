<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

/**
 * Auto mark seeder
 */
class MarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auto_marks')->delete();
        $csv = Reader::createFromPath(__DIR__ . '/data/marks.csv');
        DB::table('auto_marks')->insert($csv->fetchAssoc());
    }
}
