@include('sweetalert::alert')

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <div class="row">
        <a class="col-md-3 col-sm-6 col-xs-12" href="{{ route('users.index') }}">
            <div class="info-box">
                <span class="info-box-icon bg-aqua">
                    <i class="fas fa-users"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Usuários</span>
                    <span class="info-box-number">{{ $totalUsers }}</span>
                </div>
            </div>
        </a>

        <a class="col-md-3 col-sm-6 col-xs-12" href="{{ route('doctors.index') }}">
            <div class="info-box">
                <span class="info-box-icon bg-aqua">
                    <i class="fas fa-user-md"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Médicos</span>
                    <span class="info-box-number">{{ $totalDoctors }}</span>
                </div>
            </div>
        </a>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua">
                    <i class="fas fa-hospital-user"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Médicos Ativos</span>
                    <span class="info-box-number">{{ $totalDoctorsActives }}</span>
                </div>
            </div>
        </div>

        <a class="col-md-3 col-sm-6 col-xs-12" href="{{ route('specialties.index') }}">
            <div class="info-box">
                <span class="info-box-icon bg-aqua">
                    <i class="fas fa-layer-group"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Especialidades</span>
                    <span class="info-box-number">{{ $totalSpecialties }}</span>
                </div>
            </div>
        </a>


    </div>

@endsection
