@extends('layouts.app')

@section('content')
    <div class="card-glass">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left d-flex justify-content-center">
                        <h2>Editar Empresa</h2>
                    </div>
                </div>
            </div>
        <form action="{{ route('empresas.update', $empresa->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Nome</strong>
                        <input type="text" name="nome_empresa" class="form-control @error('nome_empresa') is-invalid @enderror"
                            placeholder="nome_empresa" value="{{ old('nome_empresa') ? old('nome_empresa') : $empresa->nome_empresa }}">
                        @error('nome_empresa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Endereço</strong>
                        <input type="text" name="endereco" class="form-control @error('endereco') is-invalid @enderror"
                            placeholder="endereco" value="{{ old('endereco') ? old('endereco') : $empresa->endereco }}">
                        @error('endereco')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Telefone</strong>
                        <input type="text" name="telefone" class="form-control @error('telefone') is-invalid @enderror"
                            placeholder="telefone" value="{{ old('telefone') ? old('telefone') : $empresa->telefone }}">
                        @error('telefone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Email</strong>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="email" value="{{ old('email') ? old('email') : $empresa->email }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Facebook</strong>
                        <input type="text" name="facebook" class="form-control @error('facebook') is-invalid @enderror"
                            placeholder="facebook" value="{{ old('facebook') ? old('facebook') : $empresa->facebook }}">
                        @error('facebook')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>WhatsApp</strong>
                        <input type="text" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror"
                            placeholder="whatsapp" value="{{ old('whatsapp') ? old('whatsapp') : $empresa->whatsapp }}">
                        @error('whatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2 text-center d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary d-flex-inline"><i class="icofont-save"></i> Atualizar</button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right d-flex">
                        <a class="btn btn-primary d-flex-inline" href="{{ route('empresas.show', $empresa->id) }}"><i class="icofont-arrow-left"></i> Voltar</a>
                    </div>
                </div>
            </div>
    </div>
@endsection
