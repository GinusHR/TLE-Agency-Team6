<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>Open Hiring</title>
    @vite('resources/js/app.js')
</head>

<body class="bg-cream sm:max-w-full">

    <header class="header">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Header Afbeelding" class="w-[4vw] left-[2vw]">
        </a>
        @if (request()->is('company*'))
        @else
            <nav class="nav-bar max-w-full">
                <!-- Dropdown Menu voor navigatie links -->
                <div class="navbar-dropdown">
                    <button class="menu-icon">
                        <span class="block w-6 h-0.5 bg-moss-dark"></span>
                        <span class="block w-6 h-0.5 bg-moss-dark"></span>
                        <span class="block w-6 h-0.5 bg-moss-dark"></span>
                    </button>

                    <!-- Dropdown content -->
                    <div class="dropdown-content">
                        <!-- Navigatie links aan de linker kant -->
                        <div class="dropdown-links">
                            <a class="nav-link-header" href="/">Homepage</a>
                            <a class="nav-link-header" href="/vacatures">Vacatures</a>
                            <a class="nav-link-header" href="/info">Informatie</a>
                        </div>

                        <!-- Login en Register knoppen aan de rechter kant -->
                        <div class="dropdown-buttons">
                            @if (Auth::user())
                                <a href="/profile" class="button-small md:mt-6">Profiel</a>
                            @else
                                <a href="/login" class="button-small mt-4">Log in</a>
                                <a href="/register" class="button-small mt-4">Register</a>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        @endif
    </header>

    <main class="bg-[#FBFCF6]">
        {{ $slot }}
    </main>


    <footer class="bg-moss-dark h-auto rounded-t-3xl max-w-full flex justify-center">
        <div class="footer-content flex flex-wrap grid grid-cols-2 grid-rows-2 ">
            <!-- Voor Werkzoekenden -->
            <div class="footer-links">
                <h3 class="h3-footer">Voor werkzoekenden</h3>
                <a class="nav-link-footer" href="/register">Vind een baan</a>
                <a class="nav-link-footer" href="/login">Veelgestelde vragen</a>
            </div>

            <div class="footer-links">
                <h3 class="h3-footer">Voor werkgevers</h3>
                <a class="nav-link-footer" href="/contact">Werken met Open Hiring</a>
                <a class="nav-link-footer" href="{{ route('company.dashboard') }}">Dashboard Bedrijf</a>
            </div>

            <!-- Over Open Hiring -->
            <div class="footer-links">
                <h3 class="h3-footer">Over open hiring</h3>
                <a class="nav-link-footer" href="/register">Onstaan</a>
                <a class="nav-link-footer" href="/login">Privacy beleid</a>
            </div>

            <!-- Volg ons op -->
            <div class="footer-links">
                <h3 class="h3-footer">Volg ons op</h3>
                <a class="nav-link-footer" href="https://www.linkedin.com/company/open-hiring-nl/"
                    target="_blank">Linkedin</a>
                <a class="nav-link-footer" href="https://www.instagram.com/openhiring_nl" target="_blank">Instagram</a>
                <a class="nav-link-footer" href="https://www.facebook.com/Openhiringnl" target="_blank">Facebook</a>
            </div>
        </div>
    </footer>

</body>

</html>
