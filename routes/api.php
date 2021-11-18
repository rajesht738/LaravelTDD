<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::apiResource('todo-list', TodoListController::class);


Route::middleware('auth:sanctum')->group(function () {
            Route:: get('todo-list', [TodoListController::class, 'index'])
                    ->name('todo-list.index');
            Route:: get('todo-list/{list}', [TodoListController::class, 'show'])
                    ->name('todo-list.show');
            Route:: post('todo-list', [TodoListController::class, 'store'])
                    ->name('todo-list.store');

            Route:: delete('todo_list/{list}', [TodoListController::class, 'destroy'])
                    ->name('todo-list.destroy');
            Route::patch('todo_list/{list}', [TodoListController::class,'update'])
                    ->name('todo-list.update');

//////// Task Route
Route::apiResource('todo-list.task', TaskController::class)->except('show')
->shallow();
Route::apiResource('label', LabelController::class);

});


// Route::get('task', [TaskController::class, 'index'])->name('task.index');
// Route::post('task', [TaskController::class, 'store'])->name('task.store');
// Route::delete('task/{task}', [TaskController::class, 'destroy'])->name('task.destroy');

Route::post('/register', RegisterController::class)->name('user.register');
Route::post('/login', LoginController::class)->name('user.login');
