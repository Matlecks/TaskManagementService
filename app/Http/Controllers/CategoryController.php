<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

/* Сервис */
use App\Services\CategoryService;

/* реквесты */
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

/* Для тайпхинтов */
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): View
    {
        $categories = $this->categoryService->getAllCategories();
        return view('pages.categories.index', compact('categories'));
    }


    public function edit($id): View
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('pages.categories.edit', compact('category'));
    }


    public function update(UpdateCategoryRequest $request, $id): RedirectResponse
    {
        $validated = $request->validated();

        $this->categoryService->updateCategory($id, $validated);

        $message = "Категория отредактирована";
        return redirect()->route('category.index')->with('message', $message);
    }


    public function create(): View
    {
        return view('pages.categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->categoryService->createCategory($validated);

        $message = "Категория создана";
        return redirect()->route('category.index')->with('message', $message);
    }


    public function destroy($id): RedirectResponse
    {
        $this->categoryService->deleteCategory($id);

        $message = "Категория удалена";
        return redirect()->route('category.index')->with('message', $message);
    }


    //Реализуйте запросы, которые используют соединение нескольких таблиц (например, получение всех задач по категории).
    public function getTasksByCategory($categoryId): JsonResponse
    {
        try {
            $tasks = $this->categoryService->getTasksByCategory($categoryId);
            return response()->json($tasks);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

}
