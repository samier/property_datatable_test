<?php

use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regionRef = [
            'Thailand' => [1, 2],
            'Cambodia' => [7, 3, 4],
        ];

        $regions = [];
        $countries = \App\Model\Country\Country::query()->get();

        foreach ($countries as $country) {
            foreach ($regionRef[$country->country] as $regionCode) {
                $regions[] = [
                    'country_id' => $country->id,
                    'region' => 'Region ' . $regionCode,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        \App\Model\Country\Region::query()->insert($regions);
    }
}
