@extends('adminlte::page')

@section('title', 'Especialidades')

@section('content_header')
    <h1>Cadastrar Especialidades</h1>
@stop

@section('content')
    <form action="{{ route('specialties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('admin.specialties._partials.form')
    </form>
@endsection
