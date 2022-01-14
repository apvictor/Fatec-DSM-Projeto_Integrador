@extends('adminlte::page')

@section('title', "Editar o tipo {$type->type}")

@section('content_header')
    <h1>Editar o tipo <b>{{ $type->type }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('types.update', $type->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.types._partials.form')
            </form>
        </div>
    </div>
@endsection
