<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #343a40;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 800px;
            width: 100%;
            padding: 20px;
            text-align: center;
        }
        .navbar {
            background-color: #343a40;
            padding: 10px 0;
            margin-bottom: 20px;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .navbar a {
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .navbar a:hover {
            background-color: #495057;
            transform: translateY(-3px);
        }
        .navbar a.active {
            background-color: #007bff;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .content h1 {
            margin-top: 0;
            font-size: 2.5rem;
            color: #007bff;
        }
        .content p {
            margin-bottom: 20px;
            font-size: 1.2rem;
            color: #6c757d;
        }
        .content .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .content .btn:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
<div class="container">
    <nav class="navbar">
        <a href="{{ route('employees.index') }}">Employees</a>
        <a href="{{ route('phones.index') }}">Phones</a>
        <a href="{{ route('users.index') }}">Users</a>
        <a href="{{ route('csv.index') }}">CSV</a>
    </nav>

    <div class="content">
        <h1>Управление таблицами</h1>
        <p>Перейти к:</p>
        <div>
            <a href="{{ route('employees.create') }}" class="btn">Add Employee</a>
            <a href="{{ route('phones.create') }}" class="btn">Add Phone</a>
            <a href="{{ route('users.create') }}" class="btn">Add User</a>
            <a href="{{ route('csv.create') }}" class="btn">Add CSV</a>
        </div>
    </div>
</div>
</body>
</html>
