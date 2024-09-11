<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();

        return view('pages.tasks.index', compact('tasks'));
    }

    public function edit($id)
    {
        $task = Task::find($id);

        // получаю все категории и убираю привязанную категорию. Для селектора
        $categories = Category::all();
        $categories = $categories->reject(function ($category) use ($task) {
            return $category->id === $task->category->id;
        });

        return view('pages.tasks.edit', compact('task', 'categories'));
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
        $categories = Category::all();

        return view('pages.tasks.create', compact('categories'));
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

        $task = Task::create($validated);

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
