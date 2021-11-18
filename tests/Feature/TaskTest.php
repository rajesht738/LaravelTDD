<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Models\TodoList;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    public function setUp():void
{
    parent::setUp();
   $this->authUser();


}
    public function test_fetch_all_task_of_todo_list()
    {



        $todo = $this->createTodoList();
        $todo2 = $this->createTodoList();
        $task = $this->createTask(['todo_list_id' => $todo->id ]);
         $this->createTask(['todo_list_id' => $todo2->id]);
        // action

        $response = $this->getJson(route('todo-list.task.index', $todo->id))->assertOk()->json();
        // assertion
        $this->assertEquals(1, count($response));
        $this->assertEquals($task->title, $response[0]['title']);
        $this->assertEquals($response[0]['todo_list_id'], $todo->id);
    }

    public function test_a_task_for_todo_list(){


        $todo = $this->createTodoList();
        $task = $this->createTask();
        $label = $this->createLabel();


        $this->postJson(route('todo-list.task.store', $todo->id),
         [
            'title'=> $task->title,
            'label_id' => $label->id
         ])->assertCreated();

        $this->assertDatabaseHas('tasks', [
            'title' => $task->title,
            'todo_list_id' => $todo->id,
            'label_id' => $label->id
        ]);
    }
    public function test_a_task_for_todo_list_without_label(){


        $todo = $this->createTodoList();
        $task = $this->createTask();



        $this->postJson(route('todo-list.task.store', $todo->id),
         [
            'title'=> $task->title,
         ])->assertCreated();

        $this->assertDatabaseHas('tasks', [
            'title' => $task->title,
            'todo_list_id' => $todo->id,
            'label_id' => null
        ]);
    }

   public function test_delete_a_task_from_database(){

                $todo = $this->createTodoList();
                $task = $this->createTask();

       $this->deleteJson(route('task.destroy', $task->id))->assertNoContent();

       $this->assertDatabaseMissing('tasks', ['title' => $task->title]);
   }

   public function test_update_task_for_todo_list(){
        $todo = $this->createTodoList();
        $task = $this->createTask();
     $this->patchJson(route('task.update', $todo->id),['title' => 'update title'])->assertOk();

     $this->assertDatabaseHas('tasks', ['title' => 'update title']);
   }
}
