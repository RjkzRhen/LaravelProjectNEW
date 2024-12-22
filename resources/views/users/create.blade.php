@extends('layouts.app')

@section('title', 'Добавить пользователя')

@section('content')
    <div class="container register-form">
        <div class="form">
            <div class="note">
                <p>Добавить пользователя</p>
            </div>

            <div class="form-content">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Фамилия:</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Фамилия" required>
                            </div>
                            <div class="form-group">
                                <label for="first_name">Имя:</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Имя" required>
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Отчество:</label>
                                <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Отчество">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="age">Возраст:</label>
                                <input type="number" name="age" id="age" class="form-control" placeholder="Возраст" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Имя пользователя:</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Имя пользователя" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Пароль:</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Пароль" required>
                            </div>
                            <!-- Добавляем поле для выбора роли -->
                            <div class="form-group">
                                <label for="role">Роль:</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="Role_ADMIN">Администратор</option>
                                    <option value="Role_USER">Пользователь</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btnSubmit">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
