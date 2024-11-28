@extends('layouts.app')

@section('title', 'Телефонный справочник')

@section('content')
    <div class="container">
        <h1 class="display-4 text-primary mb-4">Телефонный справочник</h1>
        <a href="{{ route('phones.create') }}" class="btn btn-success mb-3">Добавить номер</a>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
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
                                {{ $phone->value }} <a href="{{ route('phones.edit', $phone->id) }}" class="btn btn-primary btn-sm">Редактировать</a>
                                <form action="{{ route('phones.destroy', $phone->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот номер?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                </form><br>
                            @endforeach
                            <a href="{{ route('phones.addToUser', $user->id) }}" class="btn btn-success btn-sm add-phone-btn">+</a>
                        </td>
                        <td>
                            <form action="{{ route('phones.destroyUser', $user->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этого пользователя?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Удалить пользователя</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
