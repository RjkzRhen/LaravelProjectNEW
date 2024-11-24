@extends('layouts.app')

@section('title', 'Редактировать номер')

@section('content')
    <h1>Редактировать номер</h1>
    <form action="{{ route('phones.update', $phone->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="user_id">ФИО Пользователя:</label>
        <select name="user_id" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $phone->user_id ? 'selected' : '' }}>
                    {{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }}
                </option>
            @endforeach
        </select>
        <label for="value">Номер:</label>
        <input type="text" name="value" value="{{ $phone->value }}" required>
        <button type="submit">Сохранить</button>
    </form>
@endsection
