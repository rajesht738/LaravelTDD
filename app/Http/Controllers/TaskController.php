<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TodoList $todo_list)
    {
      //  $task = Task:: all();
      // Using this everythings is handled by laravel model eloquont , we don't require to use where condition
      $task = $todo_list->tasks;
      //
     // $task = Task::where(['todo_list_id' => $todo_list->id])->get();
        return response($task);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request, TodoList $todo_list)
    {
       // dd($todo_list->id);
         $task = $todo_list->tasks()->create($request->validated());
        //  $request['todo_list_id'] = $todo_list->id;
        //  $task = Task::create($request->all());
      //   dd($task);
        return $task;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Task $task ,Request $request)
    {
        //
       $task->update($request->all());
       return response($task);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response('1', Response:: HTTP_NO_CONTENT);
    }
}
