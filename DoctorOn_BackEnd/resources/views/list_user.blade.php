@extends('template')

@section('css', 'index.css')
@section('title', 'Lista de Usuários')

@section('sidebar')
    @parent
@stop

@section('content')

    <h6 class="title">Lista de Usuários</h6>

    <div style="display: grid; justify-content: center; align-items: center;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users_all as $users)
                    <tr>
                        <td>{{ $users->name }}</td>
                        <td>{{ $users->email }}</td>
                        <td style="display: flex;">
                            <button style="height: -webkit-fill-available;" class="btn btn-primary" data-toggle="modal"
                                data-target="#edit{{ $users->id }}">Alterar</button>
                            <span style="margin: 2px"></span>
                            <form action="{{ route('user.list.destroy', $users->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                @if (Auth::user()->name == $users->name)
                                    <button type="submit" disabled class="btn btn-danger">Deletar</button>
                                @else
                                    <button type="submit" class="btn btn-danger">Deletar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="text-align: center">
            {!! $users_all->links() !!}
        </div>
    </div>

    {{-- MODAL --}}
    @foreach ($users_all as $users)
        <div class="modal fade" id="edit{{ $users->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Editar Usuário</h4>
                        <button style="position: absolute;" type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.list.update', $users->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Nome</label>
                                <input name="name" type="text" class="form-control" placeholder="Nome"
                                    value="{{ $users->name }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="text" class="form-control" placeholder="Email"
                                    value="{{ $users->email }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Alterar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop

@section('footer')
    @parent
@stop
