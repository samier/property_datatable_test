<?php

use Illuminate\Database\Seeder;

class PropertyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'type' => 'Condo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'House',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Land',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        \App\Model\Property\PropertyType::query()->insert($types);
    }
}
