<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoListTest extends TestCase
{
use RefreshDatabase;
    public function test_a_todo_List_has_many_tasks()
    {
       $list = $this->createTodoList();
       $task = $this->createTask(['todo_list_id' => $list->id]);

        $this->assertInstanceOf(Collection::class, $list->tasks);
        $this->assertInstanceOf(Task::class, $list->tasks->first());

    }

    public function test_if_todolist_is_deleted_then_all_related_task_will_also_be_deleted(){
        $list = $this->createTodoList();
        $task = $this->createTask(['todo_list_id' => $list->id]);

        $task2 = $this->createTask();

        // action
        $list->delete();
// this assertDatabaseMissing is used to chech the deleted record in the databas
        $this->assertDatabaseMissing('todo_lists', ['id' => $list->id]);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);

/// this assert for rest of the task of other todo list check
        $this->assertDatabaseHas('tasks', ['id' => $task2->id]);


    }
}
