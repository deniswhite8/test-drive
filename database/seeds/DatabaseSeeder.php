<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Database seeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(BodyTypeSeeder::class);
        $this->call(GearboxTypeSeeder::class);
        $this->call(MarkSeeder::class);
        $this->call(ModelSeeder::class);
        $this->call(GenerationSeeder::class);

        Model::reguard();
    }
}
