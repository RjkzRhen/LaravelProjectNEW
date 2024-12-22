@extends('layouts.app')

@section('title', 'Добавить номер')

@section('content')
    <div class="container register-form">
        <div class="form">
            <div class="note">
                <p>Добавить номер</p>
            </div>

            <div class="form-content">
                <form action="{{ route('phones.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Пользователь:</label>
                        <select name="user_id" class="form-select" required>
                            <option selected disabled value="">Выберите пользователя</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="phone_values_container" class="mb-3">
                        <label for="values[]" class="form-label">Номер:</label>
                        <input type="text" name="values[]" class="form-control" placeholder="Номер" required>
                    </div>
                    <button type="button" id="add_phone_button" class="btn btn-secondary mb-3">Добавить номер</button>
                    <button type="submit" class="btnSubmit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('phone_values_container');
            const addButton = document.getElementById('add_phone_button');

            addButton.addEventListener('click', function() {
                const newField = document.createElement('input');
                newField.type = 'text';
                newField.name = 'values[]';
                newField.placeholder = 'Номер';
                newField.required = true;
                newField.classList.add('form-control', 'mb-3');
                container.appendChild(newField);
            });
        });
    </script>
@endsection
