<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить пользователя</title>
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
        input[type="text"], input[type="number"], input[type="password"] {
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
    <h1>Добавить пользователя</h1>
    <form method="POST" action="{{ route('csv.store') }}">
        @csrf
        <label for="last_name">Фамилия</label>
        <input type="text" name="last_name" required>
        <label for="first_name">Имя</label>
        <input type="text" name="first_name" required>
        <label for="middle_name">Отчество</label>
        <input type="text" name="middle_name">
        <label for="age">Возраст</label>
        <input type="number" name="age" required>
        <label for="username">Имя пользователя</label>
        <input type="text" name="username" required>
        <label for="password">Пароль</label>
        <input type="password" name="password" required>
        <button type="submit">Добавить запись</button>
    </form>
</div>
</body>
</html>

