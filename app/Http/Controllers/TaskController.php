<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
{
    $tasks = Task::orderBy('position')->get();
    return view('tasks.index', compact('tasks'));
}

    public function create()
{
    return view('tasks.create');
}

   
public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    // Generate a unique random position
    do {
        $newPosition = rand(1, 1000); // You can adjust the range as needed
    } while (Task::where('position', $newPosition)->exists()); // Check for uniqueness

    // Create the new task with the unique random position
    Task::create([
        'name' => $request->name,
        'position' => $newPosition,
    ]);
    
       return redirect('tasks')->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('tasks.edit', compact('tasks'));
    }
    
    public function updateOrder(Request $request)
{
    $request->validate([
        'order' => 'required|array',
    ]);

    foreach ($request->order as $position => $id) {
        Task::where('id', $id)->update(['position' => $position]);
    }

    return response()->json(['success' => true]);
}

}