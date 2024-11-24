@extends('layouts.app')

@section('title', 'Добавить номер')

@section('content')
    <h1>Добавить номер</h1>
    <form action="{{ route('phones.store') }}" method="POST">
        @csrf
        <label for="user_id">ФИО Пользователя:</label>
        <select name="user_id" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }}</option>
            @endforeach
        </select>
        <label for="values">Номера:</label>
        <div id="phone_values_container">
            <input type="text" name="values[]" required>
        </div>
        <button type="button" id="add_phone_button">Добавить номер</button>
        <button type="submit">Добавить</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('phone_values_container');
            const addButton = document.getElementById('add_phone_button');

            addButton.addEventListener('click', function() {
                const newField = document.createElement('input');
                newField.type = 'text';
                newField.name = 'values[]';
                newField.required = true;
                container.appendChild(newField);
            });
        });
    </script>
@endsection
