@extends('adminlte::page')

@section('title', 'Médicos')

@section('content_header')
    <h1>Cadastrar Médicos</h1>
@stop

@section('content')
    <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('admin.doctors._partials.form')
    </form>
@endsection
