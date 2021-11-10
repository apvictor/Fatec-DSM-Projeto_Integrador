@extends('template')

@section('css', 'index.css')
@section('title', 'Lista de Usuários')

@section('sidebar')
    @parent
@stop

@section('content')

    <h6>Lista de Usuários</h6>

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
                            <form action="">
                                <button type="submit" class="btn btn-primary">Alterar</button>
                            </form>
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

@stop

@section('footer')
    @parent
@stop
