<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список телефонов</title>
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
    </style>
</head>
<body>
<div class="container">
    <h1>Список телефонов</h1>
    <a href="{{ route('phones.create') }}">Добавить номер</a>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>ФИО Пользователя</th>
            <th>Номер</th>
        </tr>
        </thead>
        <tbody>
        @foreach($phones as $phone)
            <tr>
                <td>{{ $phone->id }}</td>
                <td>{{ $phone->user->last_name }} {{ $phone->user->first_name }} {{ $phone->user->middle_name }}</td>
                <td>{{ $phone->value }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
