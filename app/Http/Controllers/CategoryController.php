<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('pages.categories.index', compact('categories'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('pages.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {

        // Валидируем входящие данные
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::find($id);
        $category->update($validated);

        $message = "Категория отредактирована";
        return redirect()->route('category.index')->with('message', value: $message);
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)/* : JsonResponse|mixed */
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create($validated);

        $message = "Категория создана";
        return redirect()->route('category.index')->with('message', value: $message);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        $message = "Задача удалена";
        return redirect()->route('category.index')->with('message', value: $message);
    }

    //Реализуйте запросы, которые используют соединение нескольких таблиц (например, получение всех задач по категории).
    public function getTasksByCategory($categoryId)
    {
        $category = Category::with('tasks')->find($categoryId);

        if (!$category) {
            return response()->json(['message' => 'Категория не найдена'], 404);
        }

        return response()->json($category->tasks);
    }
}
