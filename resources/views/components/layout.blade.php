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
        <a class="nav-link-header" href="/">Homepage</a>
        <a class="nav-link-header" href="/dashboard">Dashboard</a>
        <a class="nav-link-header" href="/welcome">Welcome</a>
        <a class="nav-link-header" href="/contact">Contact</a>
    </nav>
</header>


<main class="bg-[#FBFCF6]">
    {{ $slot }}
</main>


<footer class="bg-moss-dark h-max-[15vw] rounded-t-3xl">
    <div class="footer-content ">
        <div class="footer-div">
            <h3 class="h3-footer">Voor werkzoekenden</h3>
            <a class="nav-link-footer" href="/register">Vind een baan</a>
            <a class="nav-link-footer" href="/login">Veelgestelde vragen</a>
        </div>

        <div class="footer-links">
            <h3 class="h3-footer">Voor werkgevers</h3>
            <a class="nav-link-footer" href="/register">Spelregels</a>
            <a class="nav-link-footer" href="/login">Veelgestelde vragen</a>
        </div>

        <div class="footer-links">
            <h3 class="h3-footer">Over open hiring</h3>
            <a class="nav-link-footer" href="/register">Onstaan</a>
            <a class="nav-link-footer" href="/login">Privacy beleid</a>
        </div>

        <div class="footer-links">
            <h3 class="h3-footer">Volg ons op</h3>
            <a class="nav-link-footer" href="/register">Linkedin</a>
            <a class="nav-link-footer" href="/login">Instagram</a>
            <a class="nav-link-footer" href="/contact">Facebook</a>
        </div>

    </div>

</footer>
</body>
</html>
