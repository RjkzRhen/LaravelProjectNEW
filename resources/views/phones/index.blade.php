@extends('layouts.app')

@section('title', 'Телефонный справочник')

@section('content')
    <h1>Телефонный справочник</h1>
    <div class="add-phone">
        <a href="{{ route('phones.create') }}">Добавить номер</a>
    </div>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>ФИО Пользователя</th>
            <th>Номера</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }}</td>
                <td>
                    @foreach($user->phones as $phone)
                        {{ $phone->value }} <a href="{{ route('phones.edit', $phone->id) }}">Редактировать</a>
                        <form action="{{ route('phones.destroy', $phone->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот номер?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">Удалить</button>
                        </form><br>
                    @endforeach
                    <a href="{{ route('phones.addToUser', $user->id) }}">Добавить номер</a>
                </td>
                <td>
                    <form action="{{ route('phones.destroyUser', $user->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этого пользователя?');" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">Удалить пользователя</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
