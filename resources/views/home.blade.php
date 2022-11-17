@extends('layouts.app')

@section('content')
<div class="card-glass">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-6 mb-2">
            <form action="{{ route('buscarOs') }}" method="post">
            @csrf
            <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="icofont-ui-search"></i></span>
                    <input type="text" class="form-control @error('buscaOS') is-invalid @enderror" name="buscaOS" placeholder="Buscar OS" value="{{ old('$buscaos') }}">
                </form>
                @error('buscaOS')
                    <div class="invalid-feedback">O número de OS digitado não existe!!!</div>
                @enderror
              </div>
        </div>
    </div>
</div>
@endsection
