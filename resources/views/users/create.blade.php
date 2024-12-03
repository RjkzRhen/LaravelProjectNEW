@extends('layouts.app')

@section('title', 'Добавить пользователя')

@section('content')
    <div class="container">
        <h1 class="display-4 text-primary mb-4">Добавить пользователя</h1>
        <form action="{{ route('users.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label for="last_name" class="form-label">Фамилия:</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">Имя:</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="middle_name" class="form-label">Отчество:</label>
                <input type="text" name="middle_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Возраст:</label>
                <input type="number" name="age" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Имя пользователя:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль:</label>
                <input type="text" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
@endsection
