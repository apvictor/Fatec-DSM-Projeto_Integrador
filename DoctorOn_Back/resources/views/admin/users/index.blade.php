@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}" class="breadcrumb-item active">Usuários</a>
        </li>
    </ol>

    <div style="display: flex; justify-content: space-between;">
        <h1>Usuários</h1>
        <a href="{{ route('users.create') }}" class="btn btn-dark">Adicionar</a>
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
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th width="150"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td style="width=30px;">
                                <div style="display: flex;">
                                    <a style="margin: 0 5px;" href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form id="delete_from_{{ $user->id }}"
                                        action="{{ route('users.destroy', $user->id) }}" class="form"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')

                                        @if (Auth::user()->id == $user->id)
                                            <button data-id="{{ $user->id }}" class="btn btn-danger delete_data"
                                                disabled>
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @else
                                            <button data-id="{{ $user->id }}" class="btn btn-danger delete_data">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $users->links() !!}
        </div>
    </div>
@stop
