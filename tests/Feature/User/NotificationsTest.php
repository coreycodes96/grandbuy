<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class NotificationsTest extends TestCase
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

        //Checking if the admin has successfully logged in
        $this->assertTrue(Auth::check());

        //Create a notification
        DB::table('notifications')->insert([
            'id' => 1,
            'type' => 'App\Notifications\OrderNotification',
            'notifiable_type' => 'App\Models\User',
            'notifiable_id' => 1,
            'data' => '{"info":{"status":"Your order is out for delivery","amount":1,"product_name":"Car","product_image":"https:\/\/m.atcdn.co.uk\/a\/media\/w375\/3a474510dc044af396f10aefc90eea92.jpg","product_price":"20000"}}',
            'read_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);

        //Returning the admin
        return $admin;
    }

    public function test_getting_users_notifications()
    {
        //Without exception handlers
        $this->withDeprecationHandling();

        //Getting the user
        $user = $this->user();

        //Making an api call to get all the users notifications
        $response = $this->json('GET', '/notifications/show/'.$user->id);

        //Expected status code
        $response->assertStatus(200);
    }

    public function test_getting_one_notification()
    {
        //Without exception handlers
        $this->withDeprecationHandling();

        //Getting the admin
        $this->admin();

        //Getting the user
        $user = $this->user();

        $notificationId = 1;

        //Making an api call to get a certain notification
        $response = $this->json('GET', '/notifications/notification/'.$notificationId);

        //Expected status code
        $response->assertStatus(200);
    }

    public function test_deleting_a_notification()
    {
        //Without exception handlers
        $this->withDeprecationHandling();

        //Getting the admin
        $this->admin();

        //Getting the user
        $this->user();

        $notificationId = 1;

        //Making an api call to delete a notification
        $response = $this->json('DELETE', '/notifications/delete/'.$notificationId);

        //Expected status code
        $response->assertStatus(204);
    }
}
