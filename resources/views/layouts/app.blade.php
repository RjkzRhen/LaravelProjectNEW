<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .thead-dark th {
            background-color: #343a40;
            color: #ffffff;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        .pagination .page-link {
            color: #007bff;
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #dee2e6;
        }
        .pagination .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        body {
            display: flex;
            height: 100vh;
            background-color: #f8f9fa;
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
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar .nav-link {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
            color: #ffffff;
        }
        .sidebar .nav-link.active {
            background-color: #0033ff;
            color: #ffffff;
        }
        .sidebar .submenu {
            display: none;
            background-color: #495057;
            padding: 10px;
            box-sizing: border-box;
            border-radius: 5px;
            margin-left: 15px;
        }
        .sidebar .submenu .nav-link {
            padding: 5px 15px;
        }
        .sidebar .submenu .nav-link:hover {
            background-color: #5a6268;
        }
        .content {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
            margin-left: 250px;
        }
        .add-phone-btn {
            background: none;
            border: none;
            color: #007bff;
            font-size: 1.5rem;
            padding: 0;
            margin-left: 10px;
            vertical-align: middle;
        }
        .add-phone-btn:hover {
            color: #0056b3;
        }
        .btn-secondary {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <a href="{{ route('home') }}" class="nav-link active">Главная</a>

    </div>
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
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
