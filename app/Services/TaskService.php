<?php

namespace App\Services;

use App\Models\Task;
use App\Models\Category;

class TaskService
{
    public function getAllTasks()
    {
        return Task::all();
    }

    public function getTaskForEdit($id)
    {
        $task = Task::find($id);
        // Получаем все категории и убираем привязанную категорию
        $categories = Category::all()->reject(function ($category) use ($task) {
            return $category->id === $task->category->id;
        });

        return ['task' => $task, 'categories' => $categories];
    }

    public function updateTask($id, array $validatedData)
    {
        $task = Task::find($id);
        $task->update($validatedData);
    }

    public function getCategories()
    {
        return Category::all();
    }

    public function storeTask(array $validatedData)
    {
        return Task::create($validatedData);
    }

    public function destroyTask($id)
    {
        $task = Task::find($id);
        $task->delete();
    }

}
