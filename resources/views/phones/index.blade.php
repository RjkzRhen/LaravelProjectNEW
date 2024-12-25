@extends('layouts.app')

@section('title', 'Телефонный справочник')

@section('content')
    <div class="content">
        <h1 class="mb-4">Телефонный справочник</h1>

        <!-- Фильтрация и сортировка -->
        <div class="d-flex justify-content-between mb-4">
            <!-- Форма для фильтрации -->
            <form action="{{ route('phones.index') }}" method="GET" class="d-flex align-items-center mr-3">

                <select name="filterField" id="filterField" class="form-control form-control-sm mr-2">
                    <option value="last_name" {{ $filterField == 'last_name' ? 'selected' : '' }}>Фамилия</option>
                    <option value="first_name" {{ $filterField == 'first_name' ? 'selected' : '' }}>Имя</option>
                </select>
                <input type="text" name="filterValue" id="filterValue" class="form-control form-control-sm mr-2" placeholder="Значение" value="{{ $filterValue }}">
                <button type="submit" class="btn btn-primary btn-sm">Фильтровать</button>
            </form>

            <!-- Форма для сортировки -->
            <form action="{{ route('phones.index') }}" method="GET" class="d-flex align-items-center">

                <select name="sortField" id="sortField" class="form-control form-control-sm mr-2">
                    <option value="id" {{ $sortField == 'id' ? 'selected' : '' }}>ID</option>
                    <option value="last_name" {{ $sortField == 'last_name' ? 'selected' : '' }}>Фамилия</option>
                    <option value="first_name" {{ $sortField == 'first_name' ? 'selected' : '' }}>Имя</option>
                </select>
                <select name="sortDirection" id="sortDirection" class="form-control form-control-sm mr-2">
                    <option value="asc" {{ $sortDirection == 'asc' ? 'selected' : '' }}>По возрастанию</option>
                    <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>По убыванию</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Сортировать</button>
            </form>
        </div>

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
