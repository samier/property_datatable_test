<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'country_code' => 'THA',
                'country' => 'Thailand',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'country_code' => 'KHM',
                'country' => 'Cambodia',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        \App\Model\Country\Country::query()->insert($countries);
    }
}
