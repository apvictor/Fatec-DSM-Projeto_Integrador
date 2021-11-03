@extends('template')

@section('css', 'contato.css')
@section('title', 'Contato')

@section('sidebar')
    @parent
@stop

@section('content')
    <div class="row">
        <div class="form">
            <h2 style="text-align: center">ENTRAR EM CONTATO</h2>
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Nome</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default" widht="20">Email</span>
                    <input type="email" class="form-control" placeholder="name@example.com"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
            <div class="mb-3">
                <span class="input-group-" id="inputGroup-sizing-default" widht="20">Mensagem</span>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"> </textarea>
            </div>

            <div class="btn">
                <button type="button" class="btn btn-secondary btn-lg btn-block">Enviar</button>
            </div>
            <div class="colunas">
                <div class="col">
                    <div class="card" style="width: 19rem;">
                        <div class="card-body">
                            <h5 class="card-title">Entre em contato conosco!</h5>
                            <h6 class="card-subtitle">Contatos:</h6>
                            <!-- dados teste-->
                            <p class="card-text">
                                Telefone: (11) 99505-2373
                                Email: Doctoron21@gmail.com
                            </p>
                            <div class="icones">
                                <a href="https://www.facebook.com" target=_”blank”>
                                    <img src="images\facebook.png">
                                </a>
                                <a href="https://www.whatsapp.com" target=_”blank”>
                                    <img src="images\whats.png">
                                </a>
                                <a href="https://www.instagram.com" target=_”blank”>
                                    <img src="images\instagram.png">
                                </a>
                                <a href="https://www.linkedin.com" target=_”blank”>
                                    <img src="images\linkedin.png">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="iframe">
                        <a href="#" class="card"><iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7379.794190636442!2d-47.33834170557198!3d-22.35751409088653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8708d2a78092b%3A0x96cc59770f976cf2!2sAv.%20Pres.%20Vargas%2C%201-799%20-%20Jardim%20Jose%20Ometto%20II%2C%20Araras%20-%20SP%2C%2013606-360!5e0!3m2!1spt-BR!2sbr!4v1635628943492!5m2!1spt-BR!2sbr"
                                width="480" height="275" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
