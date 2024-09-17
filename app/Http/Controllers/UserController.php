<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserCreateRequest;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): View
    {

        $users = $this->userService->getAllUsersFromApi();

        return view('pages.users.index', compact('users'));
    }


    public function handleUserCreated(UserCreateRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->all());
        return response()->json(['message' => 'Пользователь успешно создан!', 'user' => $user], 201);
    }
}
