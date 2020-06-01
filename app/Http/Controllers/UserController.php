<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Task;

class UserController extends Controller
{
    public function show(User $user,Task $task)
    {
        $user = User::find($user->id);
        $tasks = Task::where('user_id', $user->id)->get();
        \Debugbar::info($tasks);
        return view('users.show', ['user' => $user, 'tasks' => $tasks]);
    }
}
