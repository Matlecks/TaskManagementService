<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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

    public function handleUserCreated(Request $request)
    {

        Log::info('Received request in handleUserCreated:', $request->all());
        /* {"user":{"name":"Тест2","email":"asdasdasdasd@mail.ru"}} */
        $validator = Validator::make($request->all(), [
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|email',
        ]);

        // Если валидация не прошла, вернуть ошибки
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // не пройдена валидация
        }
        Log::info('Полученные данные:', $request->all());

        // если понадобится сохранение данных, то раскоментировать
        /* $data = $request->all();

        Log::info('Полученные данные data:', $data['user']);

        $user = new User();
        $user->name = $request->input('user.name');
        $user->email = $request->input('user.email');
        $user->save(); */

        // Возврат успешного ответа
        return response()->json(['message' => 'Пользователь успешно создан!'/* , 'user' => $user */], 201);
    }
}
