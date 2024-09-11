<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function index()
    {

        //ключ кэша
        $cacheKey = 'users_list';

        $cachedUsers = Redis::get($cacheKey);


        $userService = new UserService();

        $users = $userService->getAllUsers();
        $users = $users['data'];
        //преобразуем в коллекцию полученные данные
        $users = collect($users)->map(function ($userData) {
            return new User($userData);
        });

        if ($cachedUsers) {
            Redis::del($cachedUsers);
        }
        Redis::set($cacheKey, $users);
        Redis::setex($cacheKey, 3600, json_encode(json_encode($users)));



        return view('pages.users.index', compact('users'));
    }
}
