@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb d-flex justify-content-center">
                <div class="pull-left">
                    <h2>Adicionar Nova Ordem de Serviço</h2>
                </div>
            </div>
        </div>

        <form action="{{ route('ordens.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Cliente</strong>
                        <select name="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror">
                            <option selected disabled>Selecione o Cliente</option>
                            @if ($clientes)

                            @foreach ( $clientes as $cliente)

                            <option value="{{ $cliente->id }}" @if (old('cliente_id')  == $cliente->id) selected @endif>{{ $cliente->nome }}</option>

                            @endforeach

                            @endif
                          </select>
                        @error('cliente_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Marca</strong>
                        <select class="form-select" name="marca_id" class="form-control @error('marca_id') is-invalid @enderror">
                            <option selected disabled>Selecione a Marca</option>
                            @if ($marcas)

                            @foreach ( $marcas as $marca)

                            <option value="{{ $marca->id }}" @if (old('marca_id')  == $marca->id) selected @endif>{{ $marca->descricao }}</option>

                            @endforeach

                            @endif
                          </select>
                        @error('marca_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Tipo de Aparelho</strong>
                        <input type="text" name="tipo_aparelho" class="form-control @error('tipo_aparelho') is-invalid @enderror" placeholder="Tipo de Aparelho" value="{{ old('tipo_aparelho') }}">
                        @error('tipo_aparelho')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Modelo</strong>
                        <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror" placeholder="Modelo" value="{{ old('modelo') }}">
                        @error('modelo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Estado do Aparelho</strong>
                        <input type="text" name="estado_aparelho" class="form-control @error('estado_aparelho') is-invalid @enderror" placeholder="Estado do Aparelho" value="{{ old('estado_aparelho') }}">
                        @error('estado_aparelho')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Defeito Alegado</strong>
                        <input type="text" name="defeito_alegado" class="form-control @error('defeito_alegado') is-invalid @enderror" placeholder="Defeito Alegado" value="{{ old('defeito_alegado') }}">
                        @error('defeito_alegado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Valor do Serviço</strong>
                        <input type="number" step="any" min="0.01" name="valor_servico" class="form-control @error('valor_servico') is-invalid @enderror" placeholder="Valor Servico" value="{{ old('valor_servico') }}">
                        @error('valor_servico')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Observação</strong>
                        <textarea name="observacao" class="form-control @error('observacao') is-invalid @enderror">Após 30 dias de aprovado e pronto, o aparelho poderá ser vendido para cobrir despesas.</textarea>
                        @error('observacao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2 text-center d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary d-flex-inline"><i class="icofont-save"></i> Cadastrar</button>
                </div>
            </div>
        </form>
        <div class="row mt-2">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right d-flex">
                    <a class="btn btn-primary d-flex-inline" href="{{ route('marcas.index') }}"><i class="icofont-arrow-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
