<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Mijn Applicatie' }}</title>
    @vite('resources/js/app.js')
</head>

<body class="bg-cream">
<header class="header">
    <nav class="nav-bar">
        <a class="nav-link" href="/">Homepage</a>
        <a class="nav-link" href="/dashboard">Dashboard</a>
        <a class="nav-link" href="/welcome">Welcome</a>
        <a class="nav-link" href="/contact">Contact</a>
    </nav>
</header>


<main class="bg-[#FBFCF6]">
    {{ $slot }}
</main>


<footer class="footer">
    <p>&copy; {{ date('Y') }} ik ben een footer</p>
    <a href="/register">Register</a>
    <a href="/login">Log in</a>
</footer>
</body>
</html>
