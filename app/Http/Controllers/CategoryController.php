<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

/* Для тайпхинтов */
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();

        return view('pages.categories.index', compact('categories'));
    }

    public function edit($id): View
    {
        $category = Category::find($id);
        return view('pages.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id): RedirectResponse
    {

        $validated = $request->validated();

        $category = Category::find($id);
        $category->update($validated);

        $message = "Категория отредактирована";
        return redirect()->route('category.index')->with('message', value: $message);
    }

    public function create(): View
    {
        return view('pages.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validated();

        $category = Category::create($validated);

        $message = "Категория создана";
        return redirect()->route('category.index')->with('message', value: $message);
    }

    public function destroy($id): RedirectResponse
    {
        $category = Category::find($id);

        $category->delete();

        $message = "Задача удалена";
        return redirect()->route('category.index')->with('message', value: $message);
    }

    //Реализуйте запросы, которые используют соединение нескольких таблиц (например, получение всех задач по категории).
    public function getTasksByCategory($categoryId): JsonResponse
    {
        $category = Category::with('tasks')->find($categoryId);

        if (!$category) {
            return response()->json(['message' => 'Категория не найдена'], 404);
        }

        return response()->json($category->tasks);
    }
}
