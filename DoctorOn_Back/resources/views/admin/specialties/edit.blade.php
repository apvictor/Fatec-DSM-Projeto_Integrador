@extends('adminlte::page')

@section('title', "Editar a especialidade {$specialty->specialty}")

@section('content_header')
    <h1>Editar a especialidade <b>{{ $specialty->specialty }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('specialties.update', $specialty->id) }}" class="form" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.specialties._partials.form')
            </form>
        </div>
    </div>
@endsection
