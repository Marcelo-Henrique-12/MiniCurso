@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1>Cadastrar Produto</h1>
@stop

@section('content')
    <div class="card card-secondary card-outline">
        <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

                <div class="row">
                    <div class="form-group col-md-6 d-flex justify-content-start align-items-center d-none">
                        <img id="foto-preview" src="#" alt="Prévia do Foto" class="img-thumbnail"
                            style="display: none; max-width: 250px; max-height: 250px;">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-xl-4 " id="foto">
                        <label for="foto">Foto <abbr title="Campo Obrigatório" class="text-danger">*</abbr></label>
                        <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto"
                            name="foto" accept="image/*" onchange="previewFoto(event)">
                        <small class="text-muted">
                            Tamanho máximo: 2 MB.
                        </small>
                        @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 d-flex justify-content-start align-items-center">
                        <img id="foto-preview" src="#" alt="Prévia do Foto" class="img-thumbnail"
                            style="display: none; max-width: 250px; max-height: 250px;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 form-group">
                        <label for="nome">Nome<abbr title="Campo Obrigatório" class="text-danger">*</abbr></label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome"
                            placeholder="Nome do produto" value="{{ old('nome') ?? '' }}">
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-xl-4 ">
                        <label for="categoria_id">Categoria do Produto<abbr title="Campo Obrigatório"
                                class="text-danger">*</abbr></label>
                        <div class="d-flex align-items-center">
                            <select name="categoria_id" id="categoria_id" class="form-control">
                                <option selected value="">Selecione uma Categoria</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ (int) old('categoria_id') === $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-end">
                        <div class="">
                            <img id="categoria-icon" src="" alt="Ícone da Categoria"
                                style="display:none; margin-left: 10px; width: 50; height: 50px;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 form-group">
                        <label for="valor">Valor<abbr title="Campo Obrigatório" class="text-danger">*</abbr></label>
                        <input type="text" class="form-control @error('valor') is-invalid @enderror" id="valor"
                            name="valor" placeholder="Valor do produto" value="{{ old('valor') ?? '' }}">
                        @error('valor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-4 form-group">
                        <label for="quantidade">Quantidade Disponível<abbr title="Campo Obrigatório"
                                class="text-danger">*</abbr></label>
                        <input type="number" class="form-control @error('quantidade') is-invalid @enderror" id="quantidade"
                            name="quantidade" placeholder="Quantidade do produto em estoque"
                            value="{{ old('quantidade') ?? '' }}">
                        @error('quantidade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="card-footer">
                    <a href="{{ route('produtos.index') }}" type="button" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
        </form>
    </div>
@stop


@section('js')
    <script>
        function previewFoto(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('foto-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        document.getElementById('valor').addEventListener('input', function(e) {
            let value = e.target.value;

            value = value.replace(/[^0-9,]/g, '');

            let parts = value.split(',');
            if (parts.length > 2) {
                parts = [parts[0], parts.slice(1).join('')];
            }

            if (parts[1]) {
                parts[1] = parts[1].slice(0, 2);
            }

            e.target.value = parts.join(',');
        });

        document.getElementById('valor').addEventListener('blur', function(e) {
            let value = e.target.value;


            if (value.endsWith(',')) {
                value = value.slice(0, -1);
            }

            if (value && !value.includes(',')) {
                value += ',00';
            }

            e.target.value = value;
        });

    </script>
@stop
