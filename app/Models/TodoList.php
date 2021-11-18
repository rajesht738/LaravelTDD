<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TodoList extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id'];

// This boot method is used when we want to delete the related all tasks of todoList
// there are three method to delete all task one method can be use on model and second one can be use
// on controller and third one can be use on migration while creation table in database

// public static function boot(){

//     parent::boot();
//     // self::deleting(function($todo_list){
//     //         $todo_list->tasks->each->delete();
//     // });
// }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

}
