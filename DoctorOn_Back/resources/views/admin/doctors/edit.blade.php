@extends('adminlte::page')

@section('title', "Editar o médico {$doctor->doctor}")

@section('content_header')
    <h1>Editar o Médico <b>{{ $doctor->doctor }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('doctors.update', $doctor->id) }}" class="form" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.doctors._partials.form')
            </form>
        </div>
    </div>
@endsection
