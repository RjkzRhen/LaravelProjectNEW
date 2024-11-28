<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #ffffff;
            padding: 20px;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
        }
        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 10px 0;
            transition: background-color 0.3s;
            position: relative;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar a::after {
            content: '▼';
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            transition: transform 0.3s;
        }
        .sidebar a.open::after {
            transform: translateY(-50%) rotate(180deg);
        }
        .sidebar .submenu {
            display: none;
            background-color: #495057;
            padding: 10px;
            box-sizing: border-box;
        }
        .sidebar .submenu a {
            display: block;
            padding: 5px 0;
            color: #ffffff;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .sidebar .submenu a:hover {
            background-color: #5a6268;
        }
        .content {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
            margin-left: 250px;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <a href="#" onclick="toggleSubmenu('employees')" id="employees-link">Сотрудники</a>
    <div class="submenu" id="employees">
        <a href="{{ route('employees.index') }}">Таблица</a>
    </div>

    <a href="#" onclick="toggleSubmenu('phones')" id="phones-link">Телефон</a>
    <div class="submenu" id="phones">
        <a href="{{ route('phones.index') }}">Таблица</a>
    </div>

    <a href="#" onclick="toggleSubmenu('users')" id="users-link">Пользователи</a>
    <div class="submenu" id="users">
        <a href="{{ route('users.index') }}">Таблица</a>
    </div>

    <a href="#" onclick="toggleSubmenu('csv')" id="csv-link">CSV</a>
    <div class="submenu" id="csv">
        <a href="{{ route('csv.index') }}">Таблица</a>
    </div>
</div>

<div class="content">
    <h1 class="display-4 text-primary">Добро пожаловать!</h1>
    <p class="lead text-secondary">Это главная страница вашего приложения.</p>

</div>

<script>
    function toggleSubmenu(id) {
        var submenu = document.getElementById(id);
        var link = document.getElementById(id + '-link');
        if (submenu.style.display === 'block') {
            submenu.style.display = 'none';
            link.classList.remove('open');
        } else {
            submenu.style.display = 'block';
            link.classList.add('open');
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
