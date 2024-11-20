<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\PhoneController;

Route::get('/phones', [PhoneController::class, 'index'])->name('phones.index');
Route::get('/phones/create', [PhoneController::class, 'create'])->name('phones.create');
Route::post('/phones', [PhoneController::class, 'store'])->name('phones.store');
Route::delete('/phones/{id}', [PhoneController::class, 'destroy'])->name('phones.destroy');

// Маршруты для таблицы users
Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Список пользователей
Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Форма добавления пользователя
Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Обработка формы
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Маршруты для таблицы csv
Route::get('/csv', [CsvController::class, 'index'])->name('csv.index');
Route::get('/csv/create', [CsvController::class, 'create'])->name('csv.create');
Route::post('/csv/store', [CsvController::class, 'store'])->name('csv.store');
Route::get('/csv/edit/{id}', [CsvController::class, 'edit'])->name('csv.edit');
Route::post('/csv/update/{id}', [CsvController::class, 'update'])->name('csv.update');
Route::get('/csv/destroy/{id}', [CsvController::class, 'destroy'])->name('csv.destroy');

// Главная страница
Route::get('/', function () {
    return view('welcome');
});
