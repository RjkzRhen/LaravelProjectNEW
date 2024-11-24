@extends('layouts.app')

@section('title', 'Добавить пользователя')

@section('content')
    <h1>Добавить пользователя</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="last_name">Фамилия:</label>
        <input type="text" name="last_name" required>
        <label for="first_name">Имя:</label>
        <input type="text" name="first_name" required>
        <label for="middle_name">Отчество:</label>
        <input type="text" name="middle_name">
        <label for="age">Возраст:</label>
        <input type="number" name="age" required>
        <label for="username">Имя пользователя:</label>
        <input type="text" name="username" required>
        <label for="password">Пароль:</label>
        <input type="password" name="password" required>
        <button type="submit">Добавить</button>
    </form>
@endsection
