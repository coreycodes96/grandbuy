<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_account()
    {
        //Without exception handlers
        $this->withDeprecationHandling();

        //Making an api call to create an account
        $response = $this->json('POST', '/register', [
            'username' => 'Johnny',
            'email' => 'john@hotmail.com',
            'password' => 'password',
        ]);

        //Expected status code
        $response->assertStatus(200);
    }

    public function test_login_account()
    {
        //Without exception handlers
        $this->withDeprecationHandling();

        //Making an api call to create an account
        $response = $this->json('POST', '/register', [
            'username' => 'Johnny',
            'email' => 'john@hotmail.com',
            'password' => 'password',
        ]);

        //Expected status code
        $response->assertStatus(200);
        
        //Making an api call to log the user in
        $response = $this->json('POST', '/login', [
            'email' => 'john@hotmail.com',
            'password' => 'password',
        ]);
        
        //Expected status code
        $response->assertStatus(200);
    }
}
