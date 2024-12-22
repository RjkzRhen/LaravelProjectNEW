@extends('layouts.app')

@section('title', 'Добавить сотрудника')

@section('content')
    <div class="container register-form">
        <div class="form">
            <div class="note">
                <p>Добавить сотрудника</p>
            </div>

            <div class="form-content">
                <form action="{{ route('employees.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastName">Фамилия:</label>
                                <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Фамилия" required>
                            </div>
                            <div class="form-group">
                                <label for="firstName">Имя:</label>
                                <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Имя" required>
                            </div>
                            <div class="form-group">
                                <label for="middleName">Отчество:</label>
                                <input type="text" name="middleName" id="middleName" class="form-control" placeholder="Отчество">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position">Должность:</label>
                                <input type="text" name="position" id="position" class="form-control" placeholder="Должность" required>
                            </div>
                            <div class="form-group">
                                <label for="telegramId">Telegram ID:</label>
                                <input type="text" name="telegramId" id="telegramId" class="form-control" placeholder="Telegram ID">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btnSubmit">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
