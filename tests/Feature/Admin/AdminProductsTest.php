<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AdminProductsTest extends TestCase
{
    use RefreshDatabase;

    public function admin()
    {
        //Without exception handlers
        $this->withoutExceptionHandling();

        //Creating an admin
        $admin = User::factory()->create(['admin' => 1]);

        //Authenticate admin
        $this->actingAs($admin);

        //Checking if the admin has successfully logged in
        $this->assertTrue(Auth::check());

        //Returning the admin
        return $admin;
    }

    public function user()
    {
        //Without exception handlers
        $this->withoutExceptionHandling();

        //Creating a user
        $user = User::factory()->create(['admin' => 0]);

        //Authenticate user
        $this->actingAs($user);

        //Checking if the user has successfully logged in
        $this->assertTrue(Auth::check());

        //Returning the user
        return $user;
    }

    public function test_getting_products_for_admin()
    {
        $this->withDeprecationHandling();

        //Getting the user
        $this->admin();

        //Making an api call to the server
        $response = $this->json('GET', '/admin/products/show');

        //Expected status code
        $response->assertStatus(200);
    }

    public function test_create_a_product()
    {
        //Getting the admin
        $this->admin();

        //Making an api call to create a product
        $response = $this->json('POST', '/admin/products/create', [
            'name' => 'Car',
            'image' => 'image here',
            'description' => 'nice car',
            'price' => 10,
        ]);
        
        //Expected status code
        $response->assertStatus(201);
    }

    public function test_deleting_a_product()
    {
        //Getting the admin
        $this->admin();

        //Making am api call to create a product
        $response = $this->json('POST', '/admin/products/create', [
            'name' => 'Car',
            'image' => 'image here',
            'description' => 'nice car',
            'price' => 10,
        ]);
        
        //Expected status code
        $response->assertStatus(201);

        $productId = 1;

        //Making an api call to delete a product
        $deleteResponse = $this->json('DELETE', '/admin/products/delete/'.$productId);

        //Expected status code
        $deleteResponse->assertStatus(204);
    }
}
