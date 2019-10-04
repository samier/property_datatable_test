<?php

use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $properties = [];
        $faker = \Faker\Factory::create();
        for ( $iterator = 0; $iterator < 2001; $iterator++ ) {
            $property = [
                'title' => $faker->text(10),
                'description' => $faker->text,
                'bedroom' => mt_rand(1, 10),
                'bathroom' => mt_rand(1, 10),
                'property_type_id' => \App\Model\Property\PropertyType::query()->find(mt_rand(1, \App\Model\Property\PropertyType::query()->count()))->id,
                'status_id' => \App\Model\Status\Status::query()->find(mt_rand(1, \App\Model\Status\Status::query()->count()))->id,
                'for_sale' => $faker->boolean,
                'for_rent' => $faker->boolean,
                'project_id' => 1,
            ];
            $properties[] = $this->getRegion($property, $iterator);
        }

        \App\Model\Property\Property::query()->insert($properties);
        $properties = [];

        for ( $iterator = 2001; $iterator < 5001; $iterator++ ) {
            $property = [
                'title' => $faker->text(10),
                'description' => $faker->text,
                'bedroom' => mt_rand(1, 10),
                'bathroom' => mt_rand(1, 10),
                'property_type_id' => \App\Model\Property\PropertyType::query()->where('type', 'Condo')->first()->id,
                'status_id' => \App\Model\Status\Status::query()->where('status', 'active')->first()->id,
                'for_sale' => true,
                'for_rent' => $faker->boolean,
                'project_id' => \App\Model\Project\Project::query()->find(mt_rand(2, \App\Model\Project\Project::query()->count()))->id,
            ];
            $properties[] = $this->getRegion($property, $iterator);
        }

        \App\Model\Property\Property::query()->insert($properties);
        $properties = [];

        for ( $iterator = 5001; $iterator < 100000; $iterator++ ) {
            $property = [
                'title' => $faker->title,
                'description' => $faker->text(10),
                'bedroom' => mt_rand(1, 10),
                'bathroom' => mt_rand(1, 10),
                'property_type_id' => \App\Model\Property\PropertyType::query()->find(mt_rand(1, \App\Model\Property\PropertyType::query()->count()))->id,
                'status_id' => \App\Model\Status\Status::query()->find(mt_rand(1, \App\Model\Status\Status::query()->count()))->id,
                'for_sale' => $faker->boolean,
                'for_rent' => $faker->boolean,
                'project_id' => \App\Model\Project\Project::query()->find(mt_rand(2, \App\Model\Project\Project::query()->count()))->id,
            ];
            $properties[] = $this->getRegion($property, $iterator);
            if ( !($iterator % 1000) ) {
                \App\Model\Property\Property::query()->insert($properties);
                $properties = [];
            }
        }

        if ( count($properties) ) {
            \App\Model\Property\Property::query()->insert($properties);
        }
    }

    private function getRegion(array $property, $iterator) {
        $inActiveStatusId = \App\Model\Status\Status::query()->where('status', 'Inactive')->first()->id;
        $propertyTypeHouse = \App\Model\Property\PropertyType::query()->where('type', 'House')->first()->id;
        $region4Id = \App\Model\Country\Region::query()->where('region', 'Region 4')->first()->id;

        $regionId = \App\Model\Country\Region::query()->find(mt_rand(1, \App\Model\Country\Region::query()->count()))->id;
        if ( $property['property_type_id'] == $propertyTypeHouse && $propertyTypeHouse['status_id'] == $inActiveStatusId ) {
            $regionId = \App\Model\Country\Region::query()->find(mt_rand(1, $region4Id - 1))->id;
        }

        $property['region_id'] = $regionId;
        $property['created_at'] = now();
        $property['updated_at'] = now();

        return $property;
    }

}
