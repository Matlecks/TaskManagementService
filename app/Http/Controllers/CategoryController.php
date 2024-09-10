<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getTasksByCategory($categoryId)
    {
        $category = Category::with('tasks')->find($categoryId);

        if (!$category) {
            return response()->json(['message' => 'Категория не найдена'], 404);
        }

        return response()->json($category->tasks);
    }
}
