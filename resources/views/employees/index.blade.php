@extends('layouts.app')

@section('title', 'Сотрудники')

@section('content')
    <div class="content">
        <h1 class="mb-4">Сотрудники</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Добавить нового сотрудника</a>

        <div class="row">
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
