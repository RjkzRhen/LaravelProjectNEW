<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\PhoneController;

Route::get('/phones', [PhoneController::class, 'index'])->name('phones.index');
Route::get('/phones/create', [PhoneController::class, 'create'])->name('phones.create');
Route::post('/phones', [PhoneController::class, 'store'])->name('phones.store');
Route::get('/phones/{id}/edit', [PhoneController::class, 'edit'])->name('phones.edit');
Route::put('/phones/{id}', [PhoneController::class, 'update'])->name('phones.update');
Route::delete('/phones/{id}', [PhoneController::class, 'destroy'])->name('phones.destroy');
Route::get('/phones/user/{id}/add', [PhoneController::class, 'addToUser'])->name('phones.addToUser');
Route::post('/phones/user/{id}/store', [PhoneController::class, 'storeToUser'])->name('phones.storeToUser');
Route::delete('/phones/user/{id}', [PhoneController::class, 'destroyUser'])->name('phones.destroyUser');

// Маршруты для таблицы users
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
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
