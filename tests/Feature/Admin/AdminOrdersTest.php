<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderNotification;
use Tests\TestCase;

class AdminOrdersTest extends TestCase
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

        //Making an api call to create a product
        $response = $this->json('POST', '/admin/products/create', [
            'name' => 'Car',
            'image' => 'image here',
            'description' => 'nice car',
            'price' => 10,
        ]);

        //Expected status code
        $response->assertStatus(201);

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

    public function test_get_all_the_orders_for_the_admin()
    {
        //Without exception handlers
        $this->withDeprecationHandling();

        //Getting the admin
        $this->admin();

        //Making am api call to get all the orders
        $response = $this->json('GET', '/admin/orders/show');

        //Expected status code
        $response->assertStatus(200);
    }

    public function test_accepting_a_users_order()
    {
        //Without exception handlers
        $this->withDeprecationHandling();

        //Fake notifications
        Notification::fake();
        
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

        //Getting another admin
        $this->admin();

        //Send a notification
        $user->notify(new OrderNotification([]));

        //Checking the notification has been sent
        Notification::assertSentTo($user, OrderNotification::class, function ($notification, $channels) {
            return in_array('database', $channels);
        });

        //Making an call to the server to accept an order
        $acceptOrderResponse = $this->json('PUT', '/admin/orders/accept', ['id' => 1]);

        //Expected status code
        $acceptOrderResponse->assertStatus(202);
    }

    public function test_cancelling_a_users_order()
    {
        //Without exception handlers
        $this->withDeprecationHandling();

        //Fake notifications
        Notification::fake();
        
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

        //Getting the admin again
        $this->admin();

        $orderId = 1;

        //Making an api call to cancel an order
        $acceptOrderResponse = $this->json('DELETE', '/admin/orders/cancel/'.$orderId);

        //Expected status code
        $acceptOrderResponse->assertStatus(204);

        //Send a notification
        $user->notify(new OrderNotification([]));

        //Checking the notification has been sent
        Notification::assertSentTo($user, OrderNotification::class, function ($notification, $channels) {
            return in_array('database', $channels);
        });
    }
}
