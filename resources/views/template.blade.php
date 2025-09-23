<!DOCTYPE html>
<html>
<head>
    <title>Laravel Daftar Mahasiswa MVC</title>
</head>
<body>
<nav>
    <a href="{{ route('mahasiswa.index') }}">Daftar Mahasiswa</a> |
    <a href="{{ route('about') }}">About</a>
</nav>
<hr>
@yield('content')
</body>
</html>
