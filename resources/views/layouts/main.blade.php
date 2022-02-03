<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="/css/styles.css">
    <!--Sortable-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto">
    <!-- Bootstrap
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    -->
    <title>@yield('title')</title>
</head>

<body>
    <header class="header">
        <nav>
            <a href="/" class="navbar-brand">
                <img src="/img/logo.svg" alt="Meus Contatos">
            </a>
            <ul class="header-menu">
                @auth
                <li class="btn-default">
                    <a href="/contacts/dashboard/list">

                        Lista De Contatos
                    </a>
                </li>
                <li class="btn-default">
                    <a href="/contacts/create">
                        Criar Contato
                    </a>
                </li>

                <li class="btn-default">
                    <form action="/logout" method="POST">
                        @csrf
                        <a href="/logout" class="nav-link" onclick="event.preventDefault();
                            this.closest('form').submit();">
                            Sair
                        </a>
                    </form>
                </li>
                @endauth
                @guest
                <li class="btn-default">
                    <a href="/login">
                        Entrar
                    </a>
                </li>
                <li class="btn-default">
                    <a href="/register">
                        Registrar-se
                    </a>
                </li>
                @endguest
            </ul>
        </nav>
    </header>
    <div>
        @if(session('msg'))
        <p class="msg">{{ session('msg') }}</p>
        @endif
    </div>
    <section class="area-secoes">

        @yield('content')
    </section>
    <footer class="footer">
        <p>Ediomar.N &copy; 2022</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>
