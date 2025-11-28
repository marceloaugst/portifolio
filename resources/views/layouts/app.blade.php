<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Portfólio de Marcelo Augusto Alves Farias - Desenvolvedor Full Stack">
        <title>@yield('title', 'Portfólio - Marcelo Augusto')</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @stack('styles')
    </head>

    <body>
        <div class="bg-animation"></div>

        <header>
            <div class="header-content container">
                <div class="logo">MA</div>
                <nav>
                    <ul>
                        <li><a href="#home">Início</a></li>
                        <li><a href="#about">Sobre</a></li>
                        <li><a href="#skills">Skills</a></li>
                        <li><a href="#contact">Contato</a></li>
                        <li>
                            @auth
                                <a href="{{ route('admin.dashboard') }}">
                                    Admin
                                </a>
                            @else
                                <a href="{{ route('login') }}">
                                    Login
                                </a>
                            @endauth
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            <div class="container">
                <div class="footer-content">
                    <p>&copy; {{ date('Y') }} Marcelo Augusto Alves Farias. Todos os direitos reservados.</p>
                    <div class="footer-tech">
                        <i class="fab fa-laravel"></i>
                        <span>Desenvolvido totalmente em <strong>Laravel</strong></span>
                    </div>
                </div>
            </div>
        </footer>

        @stack('scripts')
    </body>

</html>
