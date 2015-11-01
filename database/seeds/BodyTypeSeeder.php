<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

/**
 * Body type seeder
 */
class BodyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auto_body_types')->delete();
        $csv = Reader::createFromPath(__DIR__ . '/data/body_types.csv');
        DB::table('auto_body_types')->insert($csv->fetchAssoc());
    }
}
