@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <div class="login-form-container">
        <h3>Вход</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Имя пользователя *" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Пароль *" required />
            </div>
            <button type="submit" class="btn btn-primary btn-block">Войти</button>
        </form>
    </div>
@endsection
