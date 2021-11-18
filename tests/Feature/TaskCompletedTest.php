<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskCompletedTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_task_status_can_be_changed()
    {

       $this->authUser();
       $task = $this->createTask();

       $this->patchJson(route('task.update', $task->id), ['status' => Task:: STARTED]);

       $this->assertDatabaseHas('tasks', ['status' => Task::STARTED]);


    }
}
