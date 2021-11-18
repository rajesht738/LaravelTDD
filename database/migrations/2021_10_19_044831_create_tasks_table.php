<?php

use App\Models\Task;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
           // $table->unsignedBigInteger('todo_list_id');
// there are three method to delete all task one method can be use on model and second one can be use
// on controller and third one can be use on migration while creation table in database
// many task are related to single todo list
// when we delete the todo list then all task related to that todo list will automatically deleted
            $table->foreignId('todo_list_id')
              ->constrained()
              ->onDelete('cascade');
              $table->text('description')->nullable();
              $table->foreignId('label_id')->nullable()->constrained();
            $table->string('status')->default(Task:: NOT_STARTED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
