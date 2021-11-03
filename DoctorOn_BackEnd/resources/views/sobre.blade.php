@extends('template')

@section('css', 'sobre.css')
@section('title', 'Sobre')

@section('sidebar')
    @parent
@stop

@section('content')
    <section id="sobre">
        <div class="col">
            <div class="sobre-txt">
                <h2>DoctorOn</h2>
                <p>Uma poderosa ferramenta para ajudar os usuários do SUS.</p>
                <p>Consiste em um aplicativo que possibilita aos usuários do SUS consultar médicos de acordo com a
                    especialidade, UBS(s), UPA(s) e Hospitais de acordo com a localidade informada pelo usuário no
                    aplicativo.
                </p>
            </div>
            <div class="sobre-img">
                <img src="images/medico.png">
            </div>
        </div>
    </section>
    <hr>
    <section id="unidades">
        <div class="col">
            <div class="unidades-card">
                <img src="images/consulta.png">
            </div>
            <div class="unidades-card">
                <img src="images/vacinacao.png">
            </div>
            <div class="unidades-card">
                <img src="images/hospital.png">
            </div>
        </div>
    </section>
    <hr>
    <section id="funcionalidades">
        <div class="col">
            <div class="funcionalidades-txt">
                <h3>DoctorOn</h3>
                <p>Para conhecer o aplicativo e todas as funcionalidades, assista ao vídeo ao lado.</p>
            </div>
            <div class="funcionalidades-video">
                <iframe width="400" height="215" src="https://www.youtube.com/embed/L_JSUkn7LME"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
    </section>
    <hr>


    <section id="icones">
        <div class="funcionalidades-txt">
            <h3>Serviços</h3>
        </div>
        <div style="text-align: center">
            <div class="col">
                <div class="icones-card">
                    <img src="images/baby-100.png">
                    <p>Pediatria</p>
                </div>
                <div class="icones-card">
                    <img src="images/brain-100.png">
                    <p>Psiquiatria</p>
                </div>
                <div class="icones-card">
                    <img src="images/cirurgia-100.png">
                    <p>Cirurgião</p>
                </div>
            </div>
            <div class="col">
                <div class="icones-card">
                    <img src="images/embryo-90.png">
                    <p>Obstetrícia</p>
                </div>
                <div class="icones-card">
                    <img src="images/estetoscopio-90.png" height="100" width="100">
                    <p>Clínico Geral</p>
                </div>
                <div class="icones-card">
                    <img src="images/idoso-100.png">
                    <p>Geriatra</p>
                </div>
            </div>
        </div>

    </section>
@stop

@section('footer')
    @parent
@stop
