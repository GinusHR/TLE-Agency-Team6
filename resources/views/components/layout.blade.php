<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Mijn Applicatie' }}</title>
    @vite('resources/js/app.js')
</head>

<body class="bg-[#FBFCF6]">
<header>

    <nav>
        <a class="nav-link" href="/">Home</a>
        <a class="nav-link" href="/register">Register</a>
        <a class="nav-link" href="/login">Log in</a>
        <a class="nav-link" href="/dashboard">Dashboard</a>
        <a class="nav-link" href="/welcome">Welcome</a>
    </nav>


</header>

<main class="bg-[#FBFCF6]">
    {{ $slot }}
</main>


<footer>
    <p>&copy; {{ date('Y') }} ik ben een footer</p>
</footer>
</body>
</html>
