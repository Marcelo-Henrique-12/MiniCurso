@extends('adminlte::page')

@section('title', 'Produtos')


@section('content')
    <div class="container p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Produtos</h1>
            <a href="{{ route('produtos.create') }}" class="btn btn-primary">
                Cadastrar Novo Produto
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Imagem</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                        <tr>
                            <td>{{ $produto->id }}</td>
                            <td>
                                <img src="{{ $produto->foto_url }}" alt="{{ $produto->nome }}" class="img-thumbnail" style="width: 100px;">
                            </td>
                            <td>{{ $produto->nome }}</td>
                            <td>
                                R$ {{ number_format($produto->valor, 2, ',', '.') }}
                            <td>
                                {{ $produto->categoria->nome ?? 'Sem Categoria' }}
                            </td>
                            <td>
                                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
