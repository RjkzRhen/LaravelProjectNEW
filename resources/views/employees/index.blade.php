@extends('layouts.app')

@section('title', 'Сотрудники')

@section('content')
    <div class="content">
        <h1 class="mb-4">Сотрудники</h1>

        <!-- Фильтрация и сортировка -->
        <div class="d-flex justify-content-between mb-4">
            <!-- Форма для фильтрации -->
            <form action="{{ route('employees.index') }}" method="GET" class="d-flex align-items-center mr-3">

                <select name="filterField" id="filterField" class="form-control form-control-sm mr-2">
                    <option value="lastName" {{ $filterField == 'lastName' ? 'selected' : '' }}>Фамилия</option>
                    <option value="firstName" {{ $filterField == 'firstName' ? 'selected' : '' }}>Имя</option>
                    <option value="position" {{ $filterField == 'position' ? 'selected' : '' }}>Должность</option>
                </select>
                <input type="text" name="filterValue" id="filterValue" class="form-control form-control-sm mr-2" placeholder="Значение" value="{{ $filterValue }}">
                <button type="submit" class="btn btn-primary btn-sm">Фильтровать</button>
            </form>

            <!-- Форма для сортировки -->
            <form action="{{ route('employees.index') }}" method="GET" class="d-flex align-items-center">

                <select name="sortField" id="sortField" class="form-control form-control-sm mr-2">
                    <option value="id" {{ $sortField == 'id' ? 'selected' : '' }}>ID</option>
                    <option value="lastName" {{ $sortField == 'lastName' ? 'selected' : '' }}>Фамилия</option>
                    <option value="firstName" {{ $sortField == 'firstName' ? 'selected' : '' }}>Имя</option>
                    <option value="position" {{ $sortField == 'position' ? 'selected' : '' }}>Должность</option>
                </select>
                <select name="sortDirection" id="sortDirection" class="form-control form-control-sm mr-2">
                    <option value="asc" {{ $sortDirection == 'asc' ? 'selected' : '' }}>По возрастанию</option>
                    <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>По убыванию</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Сортировать</button>
            </form>
        </div>

        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Добавить нового сотрудника</a>

        <div class="row d-flex flex-wrap">
            @foreach($employees as $employee)
                <div class="col-md-4">
                    <div class="user-card">
                        <h3>{{ $employee->lastName }} {{ $employee->firstName }}</h3>
                        <p><strong>Отчество:</strong> {{ $employee->middleName }}</p>
                        <p><strong>Должность:</strong> {{ $employee->position }}</p>
                        <p><strong>Telegram ID:</strong> {{ $employee->telegramId }}</p>
                        <div class="actions">
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-info btn-sm">Изменить</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этого сотрудника?')">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
