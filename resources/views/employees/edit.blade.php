<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            padding: 5px;
            margin-bottom: 10px;
            width: 200px;
        }
        button {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<h1>Edit Employee</h1>
<form action="{{ route('employees.update', $employee->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" value="{{ $employee->lastName }}" required>
    </div>
    <div>
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" value="{{ $employee->firstName }}" required>
    </div>
    <div>
        <label for="middleName">Middle Name:</label>
        <input type="text" id="middleName" name="middleName" value="{{ $employee->middleName }}">
    </div>
    <div>
        <label for="position">Position:</label>
        <input type="text" id="position" name="position" value="{{ $employee->position }}" required>
    </div>
    <div>
        <label for="telegramId">Telegram ID:</label>
        <input type="text" id="telegramId" name="telegramId" value="{{ $employee->telegramId }}">
    </div>
    <div>
        <button type="submit">Update</button>
    </div>
</form>
</body>
</html>
