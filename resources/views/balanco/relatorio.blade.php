@extends('layouts.app')

@section('content')
    <div class="card-glass">
        <div class="text-center">
            @if (isset($dataInicio))
                <h2>Balanço do período de {{ $dataInicio }} a {{ $dataFim }}</h2>
            @else
                <h2>Balanço de todo o Período</h2>
            @endif
            <h4 class="text-success">Recebido R${{ sprintf('%0.2f', $totalOrcamentosGerado) }} <i class="icofont-arrow-up"></i></h4>
            <h4 class="text-danger">Despesas R${{ sprintf('%0.2f', $totalPecasGerado) }} <i class="icofont-arrow-down"></i></h4>
            <h4 class="text-success">Total</h4>
            <h3 class="text-success"><i class="icofont-bank"></i> R${{ sprintf('%0.2f', $balancoGerado) }} <i class="icofont-bank"></i></h3>
        </div>
        <hr>
        <form action="{{ route('relatorio') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 mb-2">
                    <div class="form-group">
                        <strong>Data de Início</strong>
                        <input type="date" id="start_date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-2">
                    <div class="form-group">
                        <strong>Data de Início</strong>
                        <input type="date" id="end_date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-2 text-center d-flex justify-content-center">
                <button type="submit" class="btn btn-primary d-flex-inline"><i class="icofont-ui-calendar"></i> Gerar</button>
            </div>
        </form>
        <div class="row mt-2">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right d-flex">
                    <a class="btn btn-primary d-flex-inline" href="{{ route('balanco.index') }}"><i
                            class="icofont-arrow-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
