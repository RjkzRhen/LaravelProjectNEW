<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать номер</title>
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        select, input[type="text"] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Редактировать номер</h1>
    <form action="{{ route('phones.update', $phone->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="user_id">ФИО Пользователя:</label>
        <select name="user_id" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $phone->user_id ? 'selected' : '' }}>
                    {{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }}
                </option>
            @endforeach
        </select>
        <label for="value">Номер:</label>
        <input type="text" name="value" value="{{ $phone->value }}" required>
        <button type="submit">Сохранить</button>
    </form>
</div>
</body>
</html>
