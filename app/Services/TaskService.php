<?php

namespace App\Services;

use App\Models\Task;
use App\Models\Category;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{

    protected $client;
    public $cacheKey = 'users_list';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://usermanagementservice.ru/api/',
        ]);
    }

    public function getAllTasks(): Collection
    {
        return Task::all();
    }

    public function getTaskForEdit($id): array
    {
        $task = Task::find($id);

        $categories = Category::where('id', '!=', $task->category->id)->get();

        $users = $this->getAllUsersFromApi();

        return ['task' => $task, 'categories' => $categories, 'users' => $users];
    }

    public function updateTask($id, array $validatedData): void
    {
        $task = Task::find($id);
        $task->update($validatedData);
    }

    public function getCategories(): Collection
    {
        return Category::all();
    }

    public function storeTask(array $validatedData)
    {
        return Task::create($validatedData);
    }

    public function destroyTask($id): void
    {
        $task = Task::find($id);
        $task->delete();
    }


    public function getAllUsersFromApi(): Collection
    {
        $response = $this->client->get('give_users');

        $users = json_decode($response->getBody()->getContents(), true);

        $cachedUsers = Redis::get($this->cacheKey);
        if ($cachedUsers) {
            Redis::del($this->cacheKey);
        }

        $userCollection = collect($users['data'])->map(function ($userData) {
            $user = new User();
            $user->fill($userData);
            $user->id = $userData['id'];
            $user->created_at = $userData['created_at'];
            $user->updated_at = $userData['updated_at'];
            return $user;
        });


        Redis::setex($this->cacheKey, 3600, json_encode($userCollection));

        return $userCollection;
    }
}
