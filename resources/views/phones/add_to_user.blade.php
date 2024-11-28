@extends('layouts.app')

@section('title', 'Добавить номер к пользователю')

@section('content')
    <div class="container">
        <h1 class="display-4 text-primary mb-4">Добавить номер к пользователю</h1>
        <form action="{{ route('phones.storeToUser', $user->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label for="values" class="form-label">Номера:</label>
                <div id="phone_values_container">
                    <input type="text" name="values[]" class="form-control" required>
                </div>
            </div>
            <button type="button" id="add_phone_button" class="btn btn-secondary mb-3">Добавить номер</button>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('phone_values_container');
            const addButton = document.getElementById('add_phone_button');

            addButton.addEventListener('click', function() {
                const newField = document.createElement('input');
                newField.type = 'text';
                newField.name = 'values[]';
                newField.className = 'form-control mb-3';
                newField.required = true;
                container.appendChild(newField);
            });
        });
    </script>
@endsection
