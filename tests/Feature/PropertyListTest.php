<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyListTest extends TestCase {

    public function test_basic_listing() {
        $response = $this->get(route('property-list'));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonCount(20, 'data')
            ->assertJsonCount(4, 'links')
            ->assertJsonCount(7, 'meta')
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'title',
                        'description',
                        'bedroom',
                        'bathroom',
                        'property_type',
                        'status',
                        'for_sale',
                        'for_rent',
                        'project_name',
                        'country',
                    ]
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next'
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page',
                    'to',
                    'total'
                ],
            ]);
    }

    public function test_random_keyword_data_not_found_search()
    {
        $response = $this->get(route('property-list', ['keyword' => 'Some random text not in the database']));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonCount(4, 'links')
            ->assertJsonCount(7, 'meta')
            ->assertJsonCount(0, 'data');
    }

    public function test_random_keyword_search()
    {
        $response = $this->get(route('property-list', ['keyword' => 'perspiciatis']));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonCount(4, 'links')
            ->assertJsonCount(7, 'meta')
            ->assertJsonCount(20, 'data');
    }

    public function test_per_page_filter()
    {
        $response = $this->get(route('property-list', ['perPage' => 30]));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonCount(30, 'data')
            ->assertJsonCount(4, 'links')
            ->assertJsonCount(7, 'meta');
    }

    public function test_page_navigation()
    {
        $response = $this->get(route('property-list', ['page' => 2]));

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonCount(20, 'data')
            ->assertJsonCount(4, 'links')
            ->assertJsonCount(7, 'meta')
            ->assertJsonFragment([
                    'current_page' => 2,
            ]);
    }

    public function test_default_sorting()
    {
        $response = $this->get(route('property-list', ['sort' => 'asc']));
        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonFragment([
                'id' => 1,
            ])->assertJsonMissing([
                'id' => 100000,
            ]);

        $response = $this->get(route('property-list', ['sort' => 'desc']));
        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonFragment([
                'id' => 100000,
            ])->assertJsonMissing([
                'id' => 1,
            ]);

    }
}
