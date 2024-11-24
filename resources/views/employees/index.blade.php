@extends('layouts.app')

@section('title', 'Employees')

@section('content')
    <h1>Employees</h1>
    <a href="{{ route('employees.create') }}">Create New Employee</a>

    <!-- Форма фильтрации -->
    <form action="{{ route('employees.index') }}" method="GET">
        <div>
            <label for="filterField">Filter By:</label>
            <select id="filterField" name="filterField">
                <option value="">Select Field</option>
                <option value="lastName" {{ $filterField == 'lastName' ? 'selected' : '' }}>Last Name</option>
                <option value="firstName" {{ $filterField == 'firstName' ? 'selected' : '' }}>First Name</option>
                <option value="middleName" {{ $filterField == 'middleName' ? 'selected' : '' }}>Middle Name</option>
                <option value="position" {{ $filterField == 'position' ? 'selected' : '' }}>Position</option>
            </select>
        </div>
        <div>
            <label for="filterValue">Value:</label>
            <input type="text" id="filterValue" name="filterValue" value="{{ $filterValue }}">
        </div>
        <div>
            <button type="submit">Filter</button>
        </div>
    </form>

    <!-- Таблица сотрудников -->
    <table>
        <thead>
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
                    <a href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
