<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #2c3e50; /* Темнее фон */
            color: #ecf0f1; /* Светлее текст */
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 300px; /* Увеличиваем ширину боковой панели */
            background-color: #1e2a3a; /* Темно-синий фон боковой панели */
            color: #ecf0f1; /* Светлее текст */
            padding: 20px;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3); /* Тень для боковой панели */
        }
        .sidebar a {
            color: #ecf0f1; /* Светлее текст */
            text-decoration: none;
            display: block;
            padding: 10px 0;
            transition: background-color 0.3s;
            position: relative;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar a.has-submenu::after {
            content: '\F282'; /* Иконка стрелки вниз из Bootstrap Icons */
            font-family: 'bootstrap-icons';
            position: absolute;
            right: 20px; /* Добавляем отступ для иконки */
            top: 50%;
            transform: translateY(-50%);
            transition: transform 0.3s;
        }
        .sidebar a.has-submenu.open::after {
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
            color: #ecf0f1; /* Светлее текст */
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
            margin-left: 300px; /* Увеличиваем отступ для контента */
            background-color: #34495e; /* Темнее фон контента */
            color: #ecf0f1; /* Светлее текст */
        }
        .sidebar a.active {
            background-color: #007bff; /* Синий цвет для активного пункта меню */
        }
        .table-responsive table.table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table-responsive table.table th, .table-responsive table.table td {
            border: 2px solid rgba(0, 0, 0, 0.28) !important; /* Черная обводка ячеек */
            padding: 8px;
            color: #ffffff !important; /* Черный текст внутри ячеек */
        }
        .table-responsive table.table thead th {
            background-color: #34495e !important; /* Темно-синий фон для заголовков */
            color: #ecf0f1 !important; /* Светлее текст для заголовков */
        }
        .table-title {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid #000; /* Черная линия под названием таблицы */
        }
        .table-title h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #ecf0f1; /* Светлее текст для заголовка таблицы */
        }
        /* Добавляем класс для ячеек с данными */
        .table-responsive table.table tbody td {
            background-color: #5d708a;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Главная</a>
    <a href="#" onclick="toggleSubmenu('employee_directory')" id="employee_directory-link" class="nav-link has-submenu {{ request()->routeIs('employees.*') ? 'active' : '' }}">Справочник сотрудников</a>
    <div class="submenu" id="employee_directory">
        <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.index') ? 'active' : '' }}">Таблица</a>
    </div>
    <a href="#" onclick="toggleSubmenu('phone_list')" id="phone_list-link" class="nav-link has-submenu {{ request()->routeIs('phones.*') ? 'active' : '' }}">Телефонный справочник</a>
    <div class="submenu" id="phone_list">
        <a href="{{ route('phones.index') }}" class="nav-link {{ request()->routeIs('phones.index') ? 'active' : '' }}">Таблица</a>
    </div>
    <a href="#" onclick="toggleSubmenu('user_index')" id="user_index-link" class="nav-link has-submenu {{ request()->routeIs('users.*') ? 'active' : '' }}">Пользователи</a>
    <div class="submenu" id="user_index">
        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">Таблица</a>
    </div>
    @auth
        <a href="{{ route('profile.show', ['id' => Auth::user()->id]) }}" class="nav-link {{ request()->routeIs('profile.show') ? 'active' : '' }}">Профиль</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="nav-link" style="background: none; border: none; color: #ecf0f1; cursor: pointer;">Выйти</button>
        </form>
    @else
        <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">Регистрация</a>
        <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Войти в профиль</a>
    @endauth
</div>

<div class="content">
    <div class="container">
        @yield('content')
    </div>
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

    document.addEventListener('DOMContentLoaded', function() {
        var currentRoute = window.location.pathname;

        if (currentRoute.includes('employees')) {
            toggleSubmenu('employee_directory');
        } else if (currentRoute.includes('phones')) {
            toggleSubmenu('phone_list');
        } else if (currentRoute.includes('users')) {
            toggleSubmenu('user_index');
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('javascripts')
</body>
</html>
