<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Телефонный справочник</title>
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
            margin-top: 20px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .add-phone {
            margin-bottom: 20px;
        }
        .add-phone a {
            background-color: #28a745;
            color: #fff;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
        }
        .add-phone a:hover {
            background-color: #218838;
        }
        .delete-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<div class="container">
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
</div>
</body>
</html>
