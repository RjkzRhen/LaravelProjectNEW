<!DOCTYPE html>
<html lang="en">
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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать запись в CSV</title>
</head>
<body>
<h1>Редактировать запись в CSV</h1>
<form action="{{ route('csv.update', $id) }}" method="POST">
    @csrf
    @foreach($header as $index => $column)
        <label for="{{ $column }}">{{ $column }}:</label>
        <input type="text" name="{{ $column }}" value="{{ $record[$index] }}" required><br>
    @endforeach
    <button type="submit">Обновить</button>
</form>
</body>
</html>
