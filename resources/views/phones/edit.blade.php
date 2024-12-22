@extends('layouts.app')

@section('title', 'Редактировать номер')

@section('content')
    <div class="container register-form">
        <div class="form">
            <div class="note">
                <p>Редактировать номер</p>
            </div>

            <div class="form-content">
                <form action="{{ route('phones.update', $phone->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Пользователь:</label>
                        <select name="user_id" class="form-select" required>
                            <option selected disabled value="">Выберите пользователя</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $phone->user_id ? 'selected' : '' }}>
                                    {{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="value" class="form-label">Номер:</label>
                        <input type="text" name="value" class="form-control" placeholder="Номер" value="{{ $phone->value }}" required>
                    </div>
                    <button type="submit" class="btnSubmit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
