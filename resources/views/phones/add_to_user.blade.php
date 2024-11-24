@extends('layouts.app')

@section('title', 'Добавить номер к пользователю')

@section('content')
    <h1>Добавить номер к пользователю</h1>
    <form action="{{ route('phones.storeToUser', $user->id) }}" method="POST">
        @csrf
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
