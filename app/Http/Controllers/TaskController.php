<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('search') === null) {
            $tasks = Task::where('status', false)
                        ->where('user_id', \Auth::user()->id)
                        ->get();
            return view('tasks.index', compact('tasks'));
        } else {
            $search = $request->input('search');
            $tasks = Task::where('name', 'LIKE' , "%{$search}%")
                        ->where('user_id', \Auth::user()->id)
                        ->where('status', false)
                        ->get();
            return view('tasks.index', compact('tasks','search'));
                
        }
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
    public function store(Request $request)
    {   
        $rules = [
          'task_name' => 'required|max:100',
        ];
        $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];
        Validator::make($request->all(), $rules, $messages)->validate();

        $task = new Task;
        $task->name = $request->input('task_name');
        $task->user_id = \Auth::id();
        $task->save();
        return redirect('/tasks');
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
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->status === null) {
            $rules = [
                'task_name' => 'required|max:100',
            ];
            $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];
            Validator::make($request->all(), $rules, $messages)->validate();

            $task = Task::find($id);
            $task->name = $request->input('task_name');
            $task->save();
        } else {
            $task = Task::find($id);
            $task->status = true;
            $task->save();
        }

        return redirect('/tasks');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return redirect('/tasks');
    }
}
