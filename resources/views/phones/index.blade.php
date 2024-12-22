@extends('layouts.app')

@section('title', 'Телефонный справочник')

@section('content')
    <div class="content">
        <h1 class="mb-4">Телефонный справочник</h1>
        <a href="{{ route('phones.create') }}" class="btn btn-primary mb-3">Добавить номер</a>

        <div class="row">
            @foreach($users as $user)
                <div class="col-md-4">
                    <div class="user-card">
                        <h3>{{ $user->last_name }} {{ $user->first_name }}</h3>
                        <p><strong>Отчество:</strong> {{ $user->middle_name }}</p>
                        <p><strong>Номера:</strong></p>
                        <ul>
                            @foreach($user->phones as $phone)
                                <li>
                                    {{ $phone->value }}
                                    <a href="{{ route('phones.edit', $phone->id) }}" class="btn btn-info btn-sm">Редактировать</a>
                                    <form action="{{ route('phones.destroy', $phone->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот номер?')">Удалить</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('phones.addToUser', $user->id) }}" class="btn btn-success btn-sm">Добавить номер</a>
                        <form action="{{ route('phones.destroyUser', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этого пользователя?')">Удалить пользователя</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
