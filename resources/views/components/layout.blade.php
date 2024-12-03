<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Mijn Applicatie' }}</title>
    @vite('resources/js/app.js')
</head>

<body>
<header>

    <nav>
        <a href="/">Home</a>
        <a href="/register">Register</a>
        <a href="/login">Log in</a>
        <a href="/dashboard">Dashboard</a>
        <a href="/welcome">Welcome</a>
    </nav>

</header>

<main>
    {{ $slot }}
</main>

<footer>
    <p>&copy; {{ date('Y') }} ik ben een footer</p>
</footer>
</body>
</html>
