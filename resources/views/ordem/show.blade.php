@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="pull-left">
                <h2>OS Nº {{ $ordem[0]['id'] }}</h2>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Entrada:</strong>
                    {{ $ordem[0]['entrada'] }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cliente:</strong>
                    {{ $ordem[0]['nome'] }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Marca:</strong>
                    {{ $ordem[0]['marca'] }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Modelo:</strong>
                    {{ $ordem[0]['modelo'] }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tipo do Aparelho:</strong>
                    {{ $ordem[0]['tipo_aparelho'] }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Estado do Aparelho:</strong>
                    {{ $ordem[0]['estado_aparelho'] }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Defeito Alegado:</strong>
                    {{ $ordem[0]['defeito_alegado'] }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Observação:</strong>
                    {{ $ordem[0]['observacao'] }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Valor do Serviço:</strong>
                    {{ $ordem[0]['valor_servico'] ? $ordem[0]['valor_servico'] : "Não orçado"}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Entregue para:</strong>
                    {{ $ordem[0]['entregue_para'] ? $ordem[0]['entregue_para'] : "Não entregue"}}
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right d-flex">
                    <a class="btn btn-primary d-flex-inline" href="{{ route('ordens.index') }}"><i class="icofont-arrow-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
