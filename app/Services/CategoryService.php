<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function getCategoryById($id)
    {
        return Category::find($id);
    }

    public function updateCategory($id, array $validatedData)
    {
        $category = Category::find($id);
        $category->update($validatedData);
    }

    public function createCategory(array $validatedData): Category
    {
        return Category::create($validatedData);
    }

    public function deleteCategory($id): void
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        }
    }

    public function getTasksByCategory($categoryId): Collection
    {
        $category = Category::with('tasks')->find($categoryId);
        if (!$category) {
            throw new \Exception('Категория не найдена');
        }
        return $category->tasks;
    }
}
