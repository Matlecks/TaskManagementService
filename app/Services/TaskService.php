<?php

namespace App\Services;

use App\Models\Task;
use App\Models\Category;
use App\Models\User;

use GuzzleHttp\Client;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;

class TaskService
{

    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://usermanagementservice.ru/api/',
        ]);
    }

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


    public function getAllUsersFromApi()
    {
        $response = $this->client->get('give_users');

        $users = json_decode($response->getBody()->getContents(), true);
        // ключ кэша
        $cacheKey = 'users_list';
        $cachedUsers = Redis::get($cacheKey);
        if ($cachedUsers) {
            Redis::del($cacheKey);
        }

        $userCollection = collect($users['data'])->map(function ($userData) {
            $user = new User();
            $user->fill($userData);
            $user->id = $userData['id'];
            $user->created_at = $userData['created_at'];
            $user->updated_at = $userData['updated_at'];
            return $user;
        });


        Redis::setex($cacheKey, 3600, json_encode($userCollection));

        return $userCollection;
    }
}
