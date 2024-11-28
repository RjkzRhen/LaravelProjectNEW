@extends('layouts.app')

@section('title', 'Редактировать номер')

@section('content')
    <div class="container">
        <h1 class="display-4 text-primary mb-4">Редактировать номер</h1>
        <form action="{{ route('phones.update', $phone->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="user_id" class="form-label">ФИО Пользователя:</label>
                <select name="user_id" class="form-select" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $phone->user_id ? 'selected' : '' }}>
                            {{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="value" class="form-label">Номер:</label>
                <input type="text" name="value" class="form-control" value="{{ $phone->value }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
