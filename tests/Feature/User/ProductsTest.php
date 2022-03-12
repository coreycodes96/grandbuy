<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProductsTest extends TestCase
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

        //Returning user
        return $user;
    }

    public function test_getting_products()
    {
        //Without exception handlers
        $this->withDeprecationHandling();

        //Getting the user
        $user = $this->user();

        //Making an api call get all the products
        $response = $this->json('GET', '/products/show/');

        //Expected status code
        $response->assertStatus(200);
    }
}
