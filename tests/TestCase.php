<?php

namespace Tests;


use App\Models\Task;
use App\Models\User;
use App\Models\Label;
use App\Models\TodoList;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void{
        parent::setUp();
        $this->withoutExceptionHandling();


    }
    public function createTodoList($arg = []){
        return TodoList::factory()->create($arg);

    }
    public function createTask($arg = []){
        return Task::factory()->create($arg);

    }
    public function createUser($arg = []){
        return User::factory()->create($arg);

    }
    public function authUser(){
         $user = $this->createUser();

         Sanctum::actingAs($user);
         return $user;
     }
     public function createLabel($arg = []){
        return Label::factory()->create($arg);

    }
}
