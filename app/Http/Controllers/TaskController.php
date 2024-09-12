<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Сервис */
use App\Services\TaskService;

/* Реквесты */
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\UserService;
/* Для тайпхинтов */
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }


    public function index(): View
    {
        $tasks = $this->taskService->getAllTasks();
        return view('pages.tasks.index', compact('tasks'));
    }

    public function edit($id): View
    {
        $data = $this->taskService->getTaskForEdit($id);
        $task = $data['task'];
        $categories = $data['categories'];
        $users = $this->taskService->getAllUsersFromApi();

        return view('pages.tasks.edit', compact('task', 'categories', 'users'));
    }


    public function update(UpdateTaskRequest $request, $id): RedirectResponse
    {
        $validated = $request->validated();

        $this->taskService->updateTask($id, $validated);

        $message = "Задача отредактирована";
        return redirect()->route('task.index')->with('message', $message);
    }

    public function create(): View
    {
        $categories = $this->taskService->getCategories();

        $users = $this->taskService->getAllUsersFromApi();

        return view('pages.tasks.create', compact('categories', 'users'));
    }


    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->taskService->storeTask($validated);

        $message = "Задача создана";
        return redirect()->route('task.index')->with('message', $message);
    }

    public function destroy($id): RedirectResponse
    {
        $this->taskService->destroyTask($id);

        $message = "Задача удалена";
        return redirect()->route('task.index')->with('message', $message);
    }
}
