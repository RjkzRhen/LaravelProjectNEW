@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <div class="register-form-container">
        <h3>Регистрация</h3>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">Имя</label>
                        <input type="text" class="form-control" name="first_name" placeholder required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">Фамилия</label>
                        <input type="text" class="form-control" name="last_name" placeholder required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" name="password" placeholder required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="middle_name">Отчество</label>
                        <input type="text" class="form-control" name="middle_name" placeholder />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Подтверждение пароля</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="age">Возраст</label>
                        <input type="number" class="form-control" name="age" placeholder required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
                </div>
            </div>
        </form>
    </div>
@endsection
