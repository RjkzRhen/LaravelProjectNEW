@extends('layouts.app')

@section('title', 'Редактировать сотрудника')

@section('content')
    <div class="container register-form">
        <div class="form">
            <div class="note">
                <p>Редактировать сотрудника</p>
            </div>

            <div class="form-content">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastName">Фамилия:</label>
                                <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Фамилия" value="{{ $employee->lastName }}" required>
                            </div>
                            <div class="form-group">
                                <label for="firstName">Имя:</label>
                                <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Имя" value="{{ $employee->firstName }}" required>
                            </div>
                            <div class="form-group">
                                <label for="middleName">Отчество:</label>
                                <input type="text" name="middleName" id="middleName" class="form-control" placeholder="Отчество" value="{{ $employee->middleName }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position">Должность:</label>
                                <input type="text" name="position" id="position" class="form-control" placeholder="Должность" value="{{ $employee->position }}" required>
                            </div>
                            <div class="form-group">
                                <label for="telegramId">Telegram ID:</label>
                                <input type="text" name="telegramId" id="telegramId" class="form-control" placeholder="Telegram ID" value="{{ $employee->telegramId }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btnSubmit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
