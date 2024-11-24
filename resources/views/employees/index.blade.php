<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, input[type="text"] {
            padding: 5px;
            margin-bottom: 10px;
            width: 200px;
        }
        button {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        .actions {
            white-space: nowrap;
        }
        .actions a, .actions button {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<div class="container">
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
</div>
</body>
</html>
