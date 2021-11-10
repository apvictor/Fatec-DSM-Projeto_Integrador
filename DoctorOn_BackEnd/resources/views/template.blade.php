<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/@yield('css')">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoctorOn - @yield('title')</title>
</head>

<body>
    @section('sidebar')
        <nav class="navbar">
            <div class="container">
                <div class="container-fluid">
                    <div class="colunas">
                        <div style="display: flex;">
                            <img src="images/LOGO.svg" style="margin: 20px">
                            @if (Auth::user()->type == 2)
                                <p style="position: absolute; top: 35px; left: 10%; color: white;">
                                    {{ Auth::user()->name }}
                                </p>
                            @else
                                <p style="position: absolute; top: 35px; left: 10%; color: white;">
                                    {{ Auth::user()->name }}
                                </p>
                            @endif
                        </div>
                        <div style="display: flex">
                            <div class="items">
                                <a style="color: white; text-decoration: none;" href="{{ route('home.index') }}">HOME</a>
                            </div>
                            <div class="items dropdown">
                                <a data-toggle="dropdown">CADASTROS</a>
                                <ul class="dropdown-menu">
                                    <li> <a href="{{ route('doctor.index') }}">MÉDICOS</a></li>
                                    <li> <a href="{{ route('user.index') }}">USUÁRIOS</a></li>
                                    @if (Auth::user()->type == 2)
                                        <li> <a href="{{ route('specialty.index') }}">ESPECIALIDADES</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="items dropdown">
                                <a data-toggle="dropdown">LISTAS</a>
                                <ul class="dropdown-menu">
                                    <li> <a href="{{ route('doctor.list.index') }}">MÉDICOS</a></li>
                                    <li><a href="{{ route('user.list.index') }}">USUÁRIOS</a></li>
                                    @if (Auth::user()->type == 2)
                                        <li> <a href="">ESPECIALIDADES</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="items">
                                <a style="color: white; text-decoration: none;"
                                    href="{{ route('contato.index') }}">CONTATO</a>
                            </div>
                            <div class="items">
                                <a style="color: white; text-decoration: none;"
                                    href="{{ route('sobre.index') }}">SOBRE</a>
                            </div>
                            <div class="items">
                                <a style="color: white; text-decoration: none;" href="{{ route('logout') }}">LOGOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    @show

    <div class="container">
        <div>
            @if (@isset($msg))
                <p>{{ $msg }} </p>
            @endif
        </div>
        @yield('content')
    </div>

    @section('footer')
        <footer style="padding: 10px">
            <p>Todos os direitos reservados © Copyright 2021</p>
        </footer>
    @show
</body>

</html>
