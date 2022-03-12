<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;

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

    public function admin()
    {
        //Without exception handlers
        $this->withoutExceptionHandling();

        //Creating an admin
        $admin = User::factory()->create(['admin' => 1]);

        //Authenticate admin
        $this->actingAs($admin);

        //Checking if the has successfully logged in
        $this->assertTrue(Auth::check());

        //Making an api call to create a product
        $response = $this->json('POST', '/admin/products/create', [
            'name' => 'Car',
            'image' => 'image here',
            'description' => 'nice car',
            'price' => 10,
        ]);

        //Expected status code
        $response->assertStatus(201);

        //Return admin
        return $admin;
    }

    public function test_getting_users_orders()
    {
        //Without exception handlers
        $this->withDeprecationHandling();

        //Getting the user
        $user = $this->user();

        //Making an api call to get all the users orders
        $response = $this->json('GET', '/orders/show/'.$user->id);

        //Expected status code
        $response->assertStatus(200);
    }

    public function test_create_order()
    {
        //Without exception handlers
        $this->withDeprecationHandling();

        //Getting the admin
        $this->admin();

        //Getting the user
        $user = $this->user();

        //Setting item
        $items = [['item' => 1, 'amount' => 1]];

        //Making an api call to create an order
        $response = $this->json('POST', '/orders/create', [
            'userId' => $user->id,
            'items' => $items,
        ]);

        //Expected status code
        $response->assertStatus(201);
    }
}
