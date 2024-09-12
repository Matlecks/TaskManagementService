<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://usermanagementservice.ru/api/',
        ]);
    }

    public function getAllUsersFromApi()
    {
        $response = $this->client->get('give_users');
        return json_decode($response->getBody()->getContents(), true);
    }

    public function getAllUsers()
    {
        // ключ кэша
        $cacheKey = 'users_list';
        $cachedUsers = Redis::get($cacheKey);

        if ($cachedUsers) {
            return json_decode($cachedUsers, true);
        }

        $userService = new UserService();

        $users = $userService->getAllUsersFromApi();

        // Преобразуем в коллекцию полученные данные
        $usersCollection = collect($users)->map(function ($userData) {
            return new User($userData);
        });

        // Кэшируем пользователей
        Redis::setex($cacheKey, 3600, json_encode($usersCollection));

        return $usersCollection;
    }

    public function createUser(array $data)
    {
        Log::info('Полученные данные:', $data);

        // если понадобится сохранение данных, то раскоментировать
        $user = new User();
        $user->name = $data['user']['name'];
        $user->email = $data['user']['email'];
        $user->save();

        return $user;
    }
}
