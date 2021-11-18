<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\User;
use App\Models\TodoList;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    private  $list;
    /**
     * A basic feature test example.
     *
     * @return void
     */

public function setUp():void
{
    parent::setUp();
     $user = $this->authUser();
    $this->list = TodoList::factory()->create(['name' => 'my list', 'user_id' => $user->id ]);
// dd($this->list);
}
    public function test_fetch_all_todo_list()
    {

       // TodoList::create(['name'=> 'Rahul Tiwari']);
        // Preparation/ prepare
// to customise the faker variable we have to tell the substitute variable as name => my list
        //$list = TodoList::factory()->count(2)->create(['name' => 'my list']);
       // $list = TodoList::factory()->count(2)->create();
       // dd($list);
        // action/ perform
      $this->createTodoList();


        $response = $this->getJson(route('todo-list.index'));
       //dd($response->json());

        // assertion/ predict

       $this->assertEquals(1, count($response->json()));
      // $this->assertEquals('my list', $response->json()[0]['name']);
      //  $response->assertStatus(200);
    }

    public function test_fetch_single_todo_list(){
     // preperation
   // $list = TodoList::factory()->create();
     // action
     $response = $this->getJson(route('todo-list.show', $this->list->id))
                ->assertOk()
                ->json();
    // dd($response->json()['name']);
     // assertion
    // $response->assertStatus(200);
   // $response->assertOk();
    // $this->assertEquals($response->json()['name'], $list->name);
    $this->assertEquals($response['name'], $this->list->name);
 }
 public function test_store_new_todo_list(){
     //preperation
     // here we use factory make() method because it does not store the data in db directly but in create()
     // method it store the data in database this is the main difference b/w create() and make() method
     $list = TodoList::factory()->make();

     // action
     $response = $this->postJson(route('todo-list.store'),['name' =>  $list->name])
                   ->assertCreated()
                   ->json();
       // dd($response);

     // assertion
     $this->assertEquals( $list->name, $response['name']);
     $this->assertDatabaseHas('todo_lists', ['name' =>  $list->name]);
 }
// Validation for name field to store method in test
 public function test_while_storing_todo_list_name_field_is_required(){
     $this->withExceptionHandling();
     $response = $this->postJson(route('todo-list.store'))
                      ->assertUnprocessable()
                      ->assertJsonValidationErrors(['name']);

                  //  dd($response);
 }
 public function test_delete_todo_list(){
     $this->deleteJson(route('todo-list.destroy', $this->list->id))
           ->assertNoContent();

     $this->assertDatabaseMissing('todo_lists', ['name' => $this->list->name]);
 }
 public function test_update_todo_list(){
     $this->patchJson(route('todo-list.update', $this->list->id), ['name'=> 'Updated Name'])
        ->assertOk();
        $this->assertDatabaseHas('todo_lists', ['id' => $this->list->id, 'name'=> 'Updated Name' ]);
 }

 // Validation for name field to update method in test
 public function test_while_updating_todo_list_name_field_is_required(){
    $this->withExceptionHandling();
    $response = $this->patchJson(route('todo-list.update', $this->list->id))
                     ->assertUnprocessable()
                     ->assertJsonValidationErrors(['name']);

                 //  dd($response);
}
}
