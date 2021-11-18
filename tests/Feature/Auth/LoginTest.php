<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_user_can_login_with_email_and_password()
    {
        // To create a fake data to test the api we use faker library in laravel
        // To use faker library we use the factory()->create() on Model
        // and go to the factory and set the faker data on each field which you going to use in form

        $user = $this->createUser();
            $response = $this->postJson(route('user.login'),[
              'email' => $user->email,
              'password' => 'password'
            ])
            ->assertOk();

            $this->assertArrayHasKey('token', $response->json());

    }

    public function test_if_user_email_is_not_available_then_it_return_error(){

       // $user = User::factory()->create();
         $this->postJson(route('user.login'),[
            'email' =>  'tiwarirj73@gmail.com',
            'password' => 'password'
          ])
          ->assertUnauthorized();
    }

    public function test_it_raised_error_if_password_is_incorrect(){
        $user = $this->createUser();
        $this->postJson(route('user.login'),[
            'email' => $user->email,
            'password' => 'random'
          ])
          ->assertUnauthorized();
    }
}
