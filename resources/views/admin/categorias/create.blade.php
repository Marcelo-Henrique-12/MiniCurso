@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    <div class="card card-secondary card-outline">
        <form action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-7 col-md-6 form-group">
                        <label for="nome">Nome<abbr title="Campo Obrigatório" class="text-danger">*</abbr></label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome"
                            placeholder="Nome da Categoria" value="{{old('nome') ?? ''}}">
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-7 col-md-6 form-group">
                        <label for="descricao">Descrição<abbr title="Campo Obrigatório" class="text-danger">*</abbr></label>
                        <input type="text" class="form-control @error('descricao') is-invalid @enderror" name="descricao"
                            placeholder="Descrição da Categoria"  value="{{old('descricao') ?? ''}}">
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{ route('categorias.index') }}" type="button" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
@stop


