<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function getAllCategories(): Collection
    {
        return Category::all();
    }

    public function getCategoryById($id): Category
    {
        return Category::find($id);
    }

    public function updateCategory(int $id, array $validatedData): void
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

        $category->delete();
    }

    public function getTasksByCategory($categoryId): Collection
    {
        $category = Category::with('tasks')->find($categoryId);

        return $category->tasks;
    }
}
