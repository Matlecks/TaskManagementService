<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [TaskController::class, 'index'])->name('task.index'); //главная страница

Route::group(
    ['prefix' => 'task'],
    function () {

        Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('task.edit'); //Страница редактирования задачи

        Route::post('/update/{id}', [TaskController::class, 'update'])->name('task.update'); //Отправить изменения задачи

        Route::get('/create', [TaskController::class, 'create'])->name('task.create'); //Страница создания задачи

        Route::post('/store', [TaskController::class, 'store'])->name('task.store'); // Сохранение задачи

        Route::post('/destroy/{id}', [TaskController::class, 'destroy'])->name('task.destroy'); // Удаление задачи

    }
);

Route::group(
    ['prefix' => 'category'],
    function () {

        Route::get('/', [CategoryController::class, 'index'])->name('category.index'); //главная страница категорий

        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit'); //Страница редактирования категорий

        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update'); //Отправить изменения категории

        Route::get('/create', [CategoryController::class, 'create'])->name('category.create'); //Страница создания категории

        Route::post('/store', [CategoryController::class, 'store'])->name('category.store'); // Сохранение категории

        Route::post('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy'); // Удаление категории

    }
);

Route::group(
    ['prefix' => 'users'],
    function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index'); //главная страница пользователей
    }
);
