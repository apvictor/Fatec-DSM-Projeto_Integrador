<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/@yield('css')">
    <link rel="stylesheet" href="css/template.css">
    <link rel="shortcut icon" href="images/favicon.png" />

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
                                <a style="color: white; text-decoration: none;" href="{{ route('home.index') }}">Home</a>
                            </div>
                            <div class="items dropdown">
                                <a data-toggle="dropdown">Cadastros</a>
                                <ul class="dropdown-menu">
                                    <li> <a href="{{ route('doctor.index') }}">Médicos</a></li>
                                    <li> <a href="{{ route('user.index') }}">Usuários</a></li>
                                    @if (Auth::user()->type == 2)
                                        <li> <a href="{{ route('specialty.index') }}">Especialidades</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="items dropdown">
                                <a data-toggle="dropdown">Listas</a>
                                <ul class="dropdown-menu">
                                    <li> <a href="{{ route('doctor.list.index') }}">Médicos</a></li>
                                    <li><a href="{{ route('user.list.index') }}">Usuários</a></li>
                                    @if (Auth::user()->type == 2)
                                        <li> <a href="">Especialidades</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="items dropdown">
                                <a data-toggle="dropdown">Suporte</a>
                                <ul class="dropdown-menu">
                                    @if (Auth::user()->type == 1)
                                        <li> <a href="{{ route('suporte.index') }}">Pergunta</a></li>
                                    @endif
                                    @if (Auth::user()->type == 2)
                                        <li> <a href="{{ route('list.message.index') }}">Lista</a></li>
                                    @endif

                                </ul>
                            </div>
                            <div class="items">
                                <a style="color: white; text-decoration: none;" href="{{ route('logout') }}">Sair</a>
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

    <footer style="margin-top: 30px;">
        <p>Todos os direitos reservados © Copyright 2021</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
