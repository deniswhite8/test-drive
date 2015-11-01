<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

/**
 * Auto model seeder
 */
class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auto_models')->delete();
        $csv = Reader::createFromPath(__DIR__ . '/data/models.csv');
        DB::table('auto_models')->insert($csv->fetchAssoc());
    }
}
