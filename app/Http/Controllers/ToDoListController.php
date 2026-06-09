<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
{
    public function index()
    {
        $tasks = ToDoList::where('user_id', Auth::id())->get();

        return view('to_do_list', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        ToDoList::create([
            'user_id' => Auth::id(),
            'task' => $request->task,
            'due_date' => $request->due_date,
        ]);

        return redirect()->back()->with('success', 'Task added successfully!');
    }

    public function update(Request $request, $id)
    {
        $task = ToDoList::findOrFail($id);
        $task->completed = !$task->completed;
        $task->save();

        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    public function destroy($id)
    {
        $task = ToDoList::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully!');
    }
}
