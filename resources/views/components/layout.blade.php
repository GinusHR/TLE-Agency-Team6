<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Open Hiring</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-cream sm:max-w-full">

    <header class="header">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Header Afbeelding" class="w-[4vw] left-[2vw]">
        </a>
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
                            <a class="nav-link-header" href="/">Homepagina</a>
                            <a class="nav-link-header" href="/vacatures">Vacatures</a>
                            <a class="nav-link-header" href="/info">Informatie</a>
                        </div>

                        @if (Auth::user())
                            <div class="dropdown-buttons">
                                <a href="/profile" id="profileButton" class="flex button-small py-6 mt-4 mr-[2vw] ml-[3vw] justify-center items-center">Profiel</a>
                                <form class="flex flex-col align-center justify-center" method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Weet je zeker dat je wilt uitloggen?');">
                                    @csrf
                                    <button type="submit" class="flex button-small mt-4 mr-[2vw] ml-[3vw] justify-center items-center" >Uitloggen</button>
                                </form>
                            </div>
                        @elseif (Auth::guard('company')->user())
                            <!-- Login en Register knoppen aan de rechter kant -->
                            <div class="dropdown-buttons">
                                <a id="dashboardButton" href="{{ route('company.dashboard') }}" class="flex button-small py-6 mt-4 mr-[2vw] ml-[3vw] justify-center items-center">Dashboard</a>
                                <form class="flex flex-col align-center justify-center" method="POST" action="{{ route('company.logout') }}" onsubmit="return confirm('Weet je zeker dat je wilt uitloggen?');">
                                    @csrf
                                    <button type="submit" class="flex button-small mt-4 mr-[2vw] ml-[3vw] justify-center items-center" >Uitloggen</button>
                                </form>
                            </div>
                        @else
                            <!-- Login en Register knoppen aan de rechter kant -->
                            <div class="dropdown-buttons">
                                <a href="/login" class="flex button-small py-6 mt-4 mr-[2vw] ml-[3vw] justify-center items-center" id="loginButton">Inloggen</a>
                                <a href="/register" class="flex button-small py-6 mt-4 mr-[2vw] ml-[3vw] justify-center items-center" id="registerButton">Registreren</a>
                            </div>
                        @endif
                    </div>
                </div>
            </nav>
    </header>

    <main class="bg-[#FBFCF6]">
        {{ $slot }}
    </main>


    <footer class="bg-moss-dark h-auto rounded-t-3xl max-w-full flex justify-center">
        <div class="footer-content flex flex-wrap grid grid-cols-2 grid-rows-2 ">
            <!-- Voor Werkzoekenden -->
            <div class="footer-links">
                <h3 class="h3-footer">Voor werkzoekenden</h3>
                <a class="nav-link-footer" href="/vacatures">Vind een baan</a>
                <a class="nav-link-footer" href="/info">Veelgestelde vragen</a>
            </div>

            <div class="footer-links">
                <h3 class="h3-footer">Voor werkgevers</h3>
                <a class="nav-link-footer" href="/contact">Werken met Open Hiring</a>
                <a class="nav-link-footer" href="{{ route('company.dashboard') }}">Dashboard Bedrijf</a>
            </div>

            <!-- Over Open Hiring -->
            <div class="footer-links">
                <h3 class="h3-footer">Over open hiring</h3>
                <a class="nav-link-footer" href="/info">Onstaan</a>
                <a class="nav-link-footer" href="/contact">Contact</a>
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
