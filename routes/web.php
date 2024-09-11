<?php

use App\Http\Controllers\TaskController;
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

Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('task.edit'); //Страница редактирования задачи

Route::post('/update/{id}', [TaskController::class, 'update'])->name('task.update'); //Отправить изменения задачи

Route::get('/create', [TaskController::class, 'create'])->name('task.create'); //Страница создания задачи

Route::post('/store', [TaskController::class, 'store'])->name('task.store'); // Сохранение задачи

Route::post('/destroy/{id}', [TaskController::class, 'destroy'])->name('task.destroy'); // Удаление задачи


