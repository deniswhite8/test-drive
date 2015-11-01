<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

/**
 * Gearbox type seeder
 */
class GearboxTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auto_gearbox_types')->delete();
        $csv = Reader::createFromPath(__DIR__ . '/data/gearbox_types.csv');
        DB::table('auto_gearbox_types')->insert($csv->fetchAssoc());
    }
}
