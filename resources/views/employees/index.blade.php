@extends('layouts.app')

@section('title', 'Employees')

@section('content')
    <div class="container">
        <h1 class="display-4 text-primary mb-4">Сотрудники</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-success mb-3">Добавить нового сотрудника</a>

        <form action="{{ route('employees.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <select id="filterField" name="filterField" class="form-select" style="max-width: 200px;">
                    <option value="">Выберите поле</option>
                    <option value="lastName" {{ $filterField == 'lastName' ? 'selected' : '' }}>Last Name</option>
                    <option value="firstName" {{ $filterField == 'firstName' ? 'selected' : '' }}>First Name</option>
                    <option value="middleName" {{ $filterField == 'middleName' ? 'selected' : '' }}>Middle Name</option>
                    <option value="position" {{ $filterField == 'position' ? 'selected' : '' }}>Position</option>
                </select>
                <input type="text" id="filterValue" name="filterValue" value="{{ $filterValue }}" class="form-control" placeholder="Искать...">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th><a href="{{ route('employees.index', ['sort' => 'lastName', 'direction' => $sortField == 'lastName' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">Last Name</a></th>
                    <th><a href="{{ route('employees.index', ['sort' => 'firstName', 'direction' => $sortField == 'firstName' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">First Name</a></th>
                    <th><a href="{{ route('employees.index', ['sort' => 'middleName', 'direction' => $sortField == 'middleName' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">Middle Name</a></th>
                    <th><a href="{{ route('employees.index', ['sort' => 'position', 'direction' => $sortField == 'position' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">Position</a></th>
                    <th><a href="{{ route('employees.index', ['sort' => 'telegramId', 'direction' => $sortField == 'telegramId' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">Telegram ID</a></th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->lastName }}</td>
                        <td>{{ $employee->firstName }}</td>
                        <td>{{ $employee->middleName }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->telegramId }}</td>
                        <td class="actions">
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Изменить</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
