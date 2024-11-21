<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить номер к пользователю</title>
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
        input[type="text"] {
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
    <h1>Добавить номер к пользователю</h1>
    <form action="{{ route('phones.storeToUser', $user->id) }}" method="POST">
        @csrf
        <label for="values">Номера:</label>
        <div id="phone_values_container">
            <input type="text" name="values[]" required>
        </div>
        <button type="button" id="add_phone_button">Добавить номер</button>
        <button type="submit">Добавить</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('phone_values_container');
        const addButton = document.getElementById('add_phone_button');

        addButton.addEventListener('click', function() {
            const newField = document.createElement('input');
            newField.type = 'text';
            newField.name = 'values[]';
            newField.required = true;
            container.appendChild(newField);
        });
    });
</script>
</body>
</html>
