<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Label;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabelTest extends TestCase
{
use RefreshDatabase;

        public function setUp():void{
            parent::setUp();
        $this->user = $this->authUser();  // In this function Sanctum Api is used
        }


    public function test_can_create_new_label()
    {
        $label = Label::factory()->raw();
      //  dd($label);

        $this->postJson(route('label.store'), $label)
             ->assertCreated();

        $this->assertDatabaseHas('labels',  ['title' => $label['title'],'color'=> $label['color']] );
    }


    public function test_user_can_delete_a_label(){

        $label = $this->createLabel();

        $this->deleteJson(route('label.destroy', $label->id ))->assertNoContent();
// assertDatabaseMissing is used to check to the deleted data from database
        $this->assertDatabaseMissing('labels', ['title' => $label->title]);

    }


    public function test_user_can_update_label(){

        $label = $this->createLabel();
        $this->patchJson(route('label.update', $label->id),[
            'title' => $label->title,
            'color'=> 'new-color'])->assertOk();
// assertDatabaseHas is used to check the inserted data in database
        $this->assertDatabaseHas('labels', ['color' => 'new-color' ]);
   }


   public function test_user_fech_all_labels(){

     $label = $this->createLabel(['user_id' => $this->user->id]);
     $this->createLabel();

    $response = $this->getJson(route('label.index'))->assertOk()->json();
// assertEquals is used to check the fetched data
     $this->assertEquals($response['0']['title'], $label->title);

   }
}

