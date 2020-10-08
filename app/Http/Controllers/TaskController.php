<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        //$tasks = DB::table('tasks')->get();
        //return view('tasks')->with('tasks', $tasks);
        $list = Task::all();

        return response()->json($list);
    }

    public function store(Request $request)
    {
        $task = new Task;
        $task->body = $request->body;
        $task->completed = 0;
        $task->save();
        return response()->json([
            'message' => 'New task created'
        ]);
    }

    public function find($id)
    {
        return $data = Task::where('id', $id)->get();
    }

    public function update(Request $request, $id)
    {
        $task = Task::where('id', $id)->first();
        $task->body = $request->body;
        $task->completed = $request->completed;
        $task->save();
        return response()->json([
            'message' => 'Task updated'
        ]);
    }

    public function delete($id)
    {
        $task = Task::destroy($id);
        return response()->json([
            'message' => 'Task deleted'
        ]);
    }
}
