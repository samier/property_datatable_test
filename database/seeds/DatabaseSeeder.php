<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CountryTableSeeder::class);
         $this->call(RegionTableSeeder::class);

         $this->call(StatusTableSeeder::class);
         $this->call(PropertyTypeTableSeeder::class);

         $this->call(ProjectTableSeeder::class);
         $this->call(PropertyTableSeeder::class);
    }
}
