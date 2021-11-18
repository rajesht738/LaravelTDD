<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Requests\TodoListRequest;
use Symfony\Component\HttpFoundation\Response;


class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //  $list = TodoList::whereUserId(auth()->id())->get();

       $list = auth()->user()->todo_lists;
        return response($list);
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
    public function store(TodoListRequest $request)
    {
        //
        // dd(auth()->id());
      //  $request['user_id'] = auth()->id();

        return auth()->user()
                      ->todo_lists()
                       ->create($request->validated());
        //connecting with user with todo list by user_id
      // return TodoList::create($request->validated());
         // return response($list, 201);
        // return response($list, Response::HTTP_CREATED);
       // return $list; // here laravel send the status code 201 after understanding the creare method there is no need to specify the status code

     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $list)
    {
     //   $list = TodoList::findOrFail($todolist);
        return response($list);
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
    public function update(Request $request, TodoList $list)
    {
        $request->validate(['name' => ['required']]);
        $list->update($request->all());
        return response($list);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoList $list)
    {
        $list->delete();
        return response($list, Response::HTTP_NO_CONTENT);
    }
}
