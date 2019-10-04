<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status' => 'Inactive',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status' => 'Draft',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        \App\Model\Status\Status::query()->insert($status);
    }
}
