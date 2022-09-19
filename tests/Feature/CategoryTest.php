<?php

namespace Tests\Feature;

use App\Models\Categories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_category()
    {
        $response = $this->json('GET', '/api/categories');
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' =>
            [
                ['id', 'name', 'description', 'created_at', 'updated_at']
            ]
        ]);
    }

    public function test_category_store()
    {
        $data = ['name' => "test name",
            'description' => "test description",
            ];
        $response = $this->json('POST', '/api/categories',$data);
        $response->assertStatus(201);
        $response->assertJson(['data' => $data]);
    }

    public function test_category_update()
    {
        $data = ['name' => "test name",
            'description' => "test description",
        ];
        $response = $this->json('PUT', '/api/categories/1',$data);
        $response->assertStatus(200);
        $response->assertJson(['data' => $data]);
    }


    public function test_category_show()
    {
        $data = ['name' => "test name",
            'description' => "test description",
        ];
        $store = $this->json('POST', '/api/categories',$data);
        $store->assertStatus(201);
        $store->assertJson(['data' => $data]);

        $response = $this->json('GET', "/api/categories/".$store['data']['id']);

        $response->assertStatus(200);
        $response->assertJson(['data' => $data]);
    }
}
