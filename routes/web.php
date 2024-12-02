<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\EmployeeController;

// Главная страница
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Маршруты для сотрудников
Route::prefix('employee-directory')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
});

// Маршруты для телефонов
Route::prefix('phone-list')->group(function () {
    Route::get('/', [PhoneController::class, 'index'])->name('phones.index');
    Route::get('/create', [PhoneController::class, 'create'])->name('phones.create');
    Route::post('/', [PhoneController::class, 'store'])->name('phones.store');
    Route::get('/{id}/edit', [PhoneController::class, 'edit'])->name('phones.edit');
    Route::put('/{id}', [PhoneController::class, 'update'])->name('phones.update');
    Route::delete('/{id}', [PhoneController::class, 'destroy'])->name('phones.destroy');
    Route::get('/user/{id}/add', [PhoneController::class, 'addToUser'])->name('phones.addToUser');
    Route::post('/user/{id}/store', [PhoneController::class, 'storeToUser'])->name('phones.storeToUser');
    Route::delete('/user/{id}', [PhoneController::class, 'destroyUser'])->name('phones.destroyUser');
});

// Маршруты для таблицы users
Route::prefix('user-index')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Маршруты для таблицы csv
Route::prefix('csv')->group(function () {
    Route::get('/', [CsvController::class, 'index'])->name('csv.index');
    Route::get('/create', [CsvController::class, 'create'])->name('csv.create');
    Route::post('/store', [CsvController::class, 'store'])->name('csv.store');
    Route::get('/edit/{id}', [CsvController::class, 'edit'])->name('csv.edit');
    Route::post('/update/{id}', [CsvController::class, 'update'])->name('csv.update');
    Route::get('/destroy/{id}', [CsvController::class, 'destroy'])->name('csv.destroy');
});
