<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    use RefreshDatabase;
    public function test_a_user_can_register()
    {
       //preparation
       //action
       $this->postJson(route('user.register'), [
        'name' =>'Rajesh',
        'email' => 'tiwarirj73@gmail.com',
        'password' =>'12345',
        'password_confirmation' =>'12345'
    ])
       ->assertCreated();

       //Assertion
         $this->assertDatabaseHas('users', ['name' => 'Rajesh']);
    }
}
