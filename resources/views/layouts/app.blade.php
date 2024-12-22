<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<aside>
    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Главная</a>
    @auth
        <a href="{{ route('profile.show', ['id' => Auth::user()->id]) }}" class="nav-link {{ request()->routeIs('profile.show') ? 'active' : '' }}">Профиль</a>
        @if(Auth::user()->hasRole('Role_ADMIN'))
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
            <a href="{{ route('settings.showForm') }}" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">Настройки</a>
        @endif
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="nav-link" style="background: none; border: none; color: #ecf0f1; cursor: pointer;">Выйти</button>
        </form>
    @else
        <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">Регистрация</a>
        <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Войти в профиль</a>
    @endauth
</aside>

<div class="content {{ Auth::check() ? 'auth-background' : '' }}">
    @yield('content')
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
