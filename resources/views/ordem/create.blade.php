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
                        <strong>Marca</strong>
                        <input type="text" name="marca" class="form-control @error('marca') is-invalid @enderror" placeholder="marca" value="{{ old('marca') }}">
                        @error('marca')
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
                        <input type="text" name="estado_aparelho" class="form-control @error('estado_aparelho') is-invalid @enderror" placeholder="estado_aparelho" value="{{ old('estado_aparelho') }}">
                        @error('estado_aparelho')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Defeito Alegado</strong>
                        <input type="text" name="defeito_alegado" class="form-control @error('defeito_alegado') is-invalid @enderror" placeholder="defeito_alegado" value="{{ old('defeito_alegado') }}">
                        @error('defeito_alegado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Observação</strong>
                        <input type="text" name="observacao" class="form-control @error('observacao') is-invalid @enderror" placeholder="Observação" value="{{ old('observacao') }}">
                        @error('observacao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Valor do Serviço</strong>
                        <input type="number" step="any" min="0.01" name="valor_servico" class="form-control @error('valor_servico') is-invalid @enderror" placeholder="valor_servico" value="{{ old('valor_servico') }}">
                        @error('valor_servico')
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
