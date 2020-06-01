<?php

use App\Task;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TaskController@index')->name('tasks,index');

Route::group(['middleware' => 'auth'], function() {

    Route::post('/task', 'TaskController@store')->name('tasks.store');

    Route::delete('/task/{task}', function(Task $task){
        $task->delete();
    
        return back();
    });

});

Route::get('/user/{user}', 'UserController@show')->name('user.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
