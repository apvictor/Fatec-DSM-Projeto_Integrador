<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.js">
    <title>DoctorOn - Login</title>
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="images/LOGO.svg" id="icon" />
            </div>

            <div class="fadeIn first">
                <h3>Login</h3>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login.store') }}" method="POST">
                @csrf
                <input type="email" class="fadeIn second" name="email" placeholder="E-mail">
                <input type="password" class="fadeIn third" name="password" placeholder="Senha">
                <input type="submit" class="fadeIn fourth" value="Entrar">
            </form>

            <div>
                @if (@isset($msg))
                    <p>{{ $msg }}</p>
                @endif
            </div>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="{{ route('reset.index') }}">Esqueceu sua senha?</a>
                <br>
                ou
                <br>
                <a class="underlineHover" href="{{ route('register') }}">Cadastre-se</a>

            </div>

        </div>
    </div>
</body>

</html>
