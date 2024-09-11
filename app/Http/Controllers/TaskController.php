<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();

        return view('pages.main_page.index', compact('tasks'));
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return view('pages.main_page.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {

        // Валидируем входящие данные
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'user_id' => 'required',
            'category_id' => 'required',
        ]);


        $task = Task::find($id);
        $task->update($validated);

        $message = "Задача отредактирована";
        return redirect()->route('task.index')->with('message', value: $message);
    }

    public function create()
    {
        return view('pages.main_page.create'/* , compact('task') */);
    }

    public function store(Request $request)/* : JsonResponse|mixed */
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required',
            'status' => 'required',
        ]);

        $task = Task::create(attributes: $validated);

        $message = "Задача создана";
        return redirect()->route('task.index')->with('message', value: $message);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        $task->delete();

        $message = "Задача удалена";
        return redirect()->route('task.index')->with('message', value: $message);
    }
}
