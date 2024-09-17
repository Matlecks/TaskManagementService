<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://usermanagementservice.ru/api/',
        ]);
    }

    public function getAllUsersFromApi(): Collection
    {
        $response = $this->client->get('give_users');

        $users = json_decode($response->getBody()->getContents(), true);

        $cacheKey = 'users_list';
        $cachedUsers = Redis::get($cacheKey);
        if ($cachedUsers) {
            Redis::del($cacheKey);
        }

        $userCollection = collect($users['data'])->map(function ($userData) {
            return new User($userData);
        });

        Redis::setex($cacheKey, 3600, json_encode($userCollection));

        return $userCollection;
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
