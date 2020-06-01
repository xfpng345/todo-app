<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use Validator;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::all();

        // 検索機能
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            $query = Task::where('title','like', '%'.$keyword.'%');
            $tasks = $query->get();
        }


        return view('tasks',['tasks' => $tasks ]);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
        'title' => 'required|max:30',
        ]);
        if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);    
        }

        $task = new Task;
        $task->title = $request->title;
        $task->user_id = $request->user()->id;
        $task->save();
    
        return redirect('/');
    }
}
