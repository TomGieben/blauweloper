<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Font awesome --}}
    <script src="https://kit.fontawesome.com/5e3d25cf7b.js" crossorigin="anonymous"></script>

    {{-- Jquery --}}
    <script
      src="https://code.jquery.com/jquery-3.6.1.js"
      integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
      crossorigin="anonymous">
    </script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    <img src="{{ asset('img/favicon.png') }}" alt="logo"
                        style="width: 35px; height: 35px; object-fit: cover;">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                        <i class="fas fa-grid-horizontal"></i>
                                        Overzicht
                                    </a>
                                    @if(auth()->user()->hasRight([
                                        'administrator',
                                        'lid',
                                    ]))
                                        <a class="dropdown-item {{ Route::is('chess') ? 'active' : '' }}" href="{{ route('chess') }}?ai=true">
                                            <i class="fas fa-solid fa-play"></i>
                                            Spelen
                                        </a>
                                    @endif
                                    @if(auth()->user()->hasRight([
                                        'administrator',
                                        'secretariaat',
                                    ]))
                                        <a class="dropdown-item {{ Route::is('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                            <i class="fas fa-solid fa-users"></i>
                                            Gebruikers
                                        </a>
                                    @endif
                                    @if(auth()->user()->hasRight([
                                        'administrator',
                                    ]))
                                        <a class="dropdown-item {{ Route::is('groups.*') ? 'active' : '' }}" href="{{ route('groups.index') }}">
                                            <i class="fas fa-people-group"></i>
                                            Groepen
                                        </a>
                                    @endif
                                    @if(auth()->user()->hasRight([
                                        'administrator',
                                        'secretariaat',
                                        'scheidsrechter',
                                        'scholier-begeleider',
                                    ]))
                                        <a class="dropdown-item {{ Route::is('matches.*') ? 'active' : '' }}" href="{{ route('matches.index') }}">
                                            <i class="fas fa-chess"></i>
                                            Wedstrijden
                                        </a>
                                    @endif
                                    @if(auth()->user()->hasRight([
                                        'administrator',
                                    ]))
                                        <a class="dropdown-item {{ Route::is('rights.*') ? 'active' : '' }}" href="{{ route('rights.index') }}">
                                            <i class="fas fa-gavel"></i>
                                            Rechten
                                        </a>
                                    @endif
                                    <a class="dropdown-item {{ Route::is('users.edit') && request()->user->id == auth()->user()->id ? 'active' : '' }}" href="{{ route('users.edit', auth()->user()) }}">
                                        <i class="fas fa-sliders"></i>
                                        Instellingen
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">

                                        <i class="fas fa-right-from-bracket"></i>
                                        {{ __('Log uit') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    {{-- Select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Swal --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- JS --}}
    <script>
        $('.delete-user').click(function(e) {
            swal({
                title: "Weet je zeker dat je deze data wilt verwijderen?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ["Afbreken", "Doorgaan"],
            })
            .then((confirm) => {
                if (confirm) {
                    (e.target).closest('form').submit()
                    swal({
                        title: "Data verwijderd!",
                        icon: "success",
                    });
                } else {
                    swal({
                        title: "Actie afgebroken.",
                        icon: "info",
                    });
                }
            });
        });

        $(document).ready(function() {
            $('.multiple').select2();
        });
    </script>
</body>
</html>
