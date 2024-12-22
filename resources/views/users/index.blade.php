@extends('layouts.app')

@section('title', 'Список пользователей')

@section('content')
    <div class="content">
        <h1 class="mb-4">Список пользователей</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Добавить пользователя</a>

        <div class="row">
            @foreach($users as $user)
                <div class="col-md-4">
                    <div class="user-card">
                        <h3>{{ $user->last_name }} {{ $user->first_name }}</h3>
                        <p><strong>Отчество:</strong> {{ $user->middle_name }}</p>
                        <p><strong>Возраст:</strong> {{ $user->age }}</p>
                        <p><strong>Имя пользователя:</strong> {{ $user->username }}</p>
                        <div class="actions">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этого пользователя?')">Удалить</button>
                            </form>
                            <a href="{{ route('profile.show', $user->id) }}" class="btn btn-info btn-sm">Просмотр</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
