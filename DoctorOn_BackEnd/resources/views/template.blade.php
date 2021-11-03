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
        <nav class="navbar navbar-light">
            <div class="container">
                <div class="container-fluid">
                    <div class="colunas">
                        <img src="images/logo.png" alt="">
                        <div style="display: flex" class="link">
                            <div class="items">
                                <a style="color: white; text-decoration: none;" href="{{ route('home.index') }}">HOME</a>
                            </div>
                            <div class="items dropdown">
                                <a data-toggle="dropdown">CADASTROS</a>
                                <ul style="top: 25px" class="dropdown-menu">
                                    <li> <a href="{{ route('doctor.store') }}">CADASTRO DE MÉDICOS</a></li>
                                    <li> <a href="#">CADASTRO DE ESPECIALIDADES</a></li>
                                </ul>
                            </div>
                            <div class="items dropdown">
                                <a data-toggle="dropdown">LISTAS</a>
                                <ul style="top: 25px" class="dropdown-menu">
                                    <li> <a href="{{ route('doctor.store') }}">MÉDICOS</a></li>
                                    <li><a href="#">ESPECIALIDADES</a></li>
                                </ul>
                            </div>
                            <div class="items">
                                <a style="color: white; text-decoration: none;"
                                    href="{{ route('sobre.index') }}">CONTATO</a>
                            </div>
                            <div class="items">
                                <a style="color: white; text-decoration: none;"
                                    href="{{ route('sobre.index') }}">SOBRE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    @show

    <div class="container">
        @yield('content')
    </div>

    @section('footer')
        <footer>
            <h4>Fale Conosco</h4>
            <p>(11) 99505-2373</p>
            <p>Todos os direitos reservados © Copyright 2021</p>
        </footer>
    @show
</body>

</html>
