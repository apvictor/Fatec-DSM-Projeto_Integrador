@extends('adminlte::page')

@section('title', 'Tipos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('types.index') }}" class="breadcrumb-item active">Tipos</a>
        </li>
    </ol>

    <div style="display: flex; justify-content: space-between;">
        <h1>Tipos</h1>
        <a href="{{ route('types.create') }}" class="btn btn-dark">Adicionar</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{-- <form action="{{ route('categories.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtrar:" class="form-control"
                    value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form> --}}
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th width="150"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->type }}</td>
                            <td style="width=30px;">
                                <div style="display: flex;">
                                    <a style="margin: 0 5px;" href="{{ route('types.edit', $type->id) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form id="delete_from_{{ $type->id }}"
                                        action="{{ route('types.destroy', $type->id) }}" class="form"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button data-id="{{ $type->id }}" class="btn btn-danger delete_data">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $types->links() !!}
        </div>
    </div>

@stop
