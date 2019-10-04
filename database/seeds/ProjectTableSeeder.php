<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [];

        $faker = \Faker\Factory::create();
        for($iterator = 0; $iterator < 10000; $iterator++ ) {
           $projects[] = [
               'name' => $faker->firstName,
               'created_at' => now(),
               'updated_at' => now()
           ];
        }

        \App\Model\Project\Project::query()->insert($projects);
    }
}
