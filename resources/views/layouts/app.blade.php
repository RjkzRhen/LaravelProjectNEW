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
<header>
    <!-- Основное меню -->
    <nav class="main-menu">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Главная</a>
        @auth
            <a href="{{ route('profile.show', ['id' => Auth::user()->id]) }}" class="nav-link {{ request()->routeIs('profile.show') ? 'active' : '' }}">Профиль</a>
            @if(Auth::user()->hasRole('Role_ADMIN'))
                <a href="#" onclick="toggleSubmenu('tables')" id="tables-link" class="nav-link has-submenu {{ request()->routeIs('employees.*') || request()->routeIs('phones.*') || request()->routeIs('users.*') ? 'active' : '' }}">Таблица</a>
                <div class="submenu" id="tables" style="position: absolute; top: 100%; left: 10%;">
                    <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.index') ? 'active' : '' }}">Сотрудники</a>
                    <a href="{{ route('phones.index') }}" class="nav-link {{ request()->routeIs('phones.index') ? 'active' : '' }}">Телефоны</a>
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">Пользователи</a>
                </div>
                <a href="{{ route('settings.showForm') }}" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">Настройки</a>
            @endif
            <div class="logout-container">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-button">Выйти</button>
                </form>
            </div>
        @else
            <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">Регистрация</a>
            <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Войти в профиль</a>
        @endauth
    </nav>
</header>
<div class="content {{ Auth::check() ? 'auth-background' : '' }}">
    @yield('content')
</div>

<script>
    // Функция для переключения видимости подменю
    function toggleSubmenu(id) {
        var submenu = document.getElementById(id);
        var link = document.getElementById(id + '-link');
        if (submenu.style.display === 'block') {
            submenu.style.display = 'none'; // Скрываем подменю
            link.classList.remove('open');
        } else {
            submenu.style.display = 'block'; // Показываем подменю
            link.classList.add('open');
        }
    }

    // Автоматическое открытие подменю в зависимости от текущего маршрута
    document.addEventListener('DOMContentLoaded', function() {
        var currentRoute = window.location.pathname;

        if (currentRoute.includes('employees')) {
            toggleSubmenu('tables');
        } else if (currentRoute.includes('phones')) {
            toggleSubmenu('tables');
        } else if (currentRoute.includes('users')) {
            toggleSubmenu('tables');
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('javascripts')
</body>
</html>
