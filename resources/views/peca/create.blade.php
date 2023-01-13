@extends('layouts.app')

@section('content')
    <div class="card-glass">
        <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb d-flex justify-content-center">
                <div class="pull-left">
                    <h2>Adicionar Peças a Ordem de Serviço nº {{ $ordem_id }}</h2>
                </div>
            </div>
        </div>

        <form action="{{ route('pecas.store') }}" method="POST" id="form_pecas">
            @csrf
            <input type="hidden" id="ordem_id" name="ordem_id" value="{{ $ordem_id }}">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 mb-2">
                    <div class="form-group">
                        <strong>Descricao</strong>
                        <input class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" type="text" value="{{ old('descricao') }}" placeholder="Digite o Nome da Peça">
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mb-2">
                    <div class="form-group">
                        <strong>Valor da Peça</strong>
                        <input type="text" id="valor_peca" name="valor" class="form-control @error('valor') is-invalid @enderror" placeholder="Valor da Peça" value="{{ old('valor') }}">
                        @error('valor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2 text-center d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary d-flex-inline btn-submit"><i class="icofont-save"></i> Cadastrar</button>
                </div>
            </div>
        </form>
        <div class="row mt-2">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right d-flex">
                    <a class="btn btn-primary d-flex-inline" href="{{ route('ordens.index') }}"><i class="icofont-arrow-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>
    @foreach ($pecas as $peca)
        {{ $peca->descricao }}
        {{ $peca->valor }}
    @endforeach
</div>
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-submit").click(function(e){

        e.preventDefault();

        var descricao = $("#descricao").val();
        var valor = $("#valor_peca").val();
        var ordem_id = $("#ordem_id").val();

        $.ajax({
           type:'POST',
           url:"{{ route('pecas.store') }}",
           data:{descricao:descricao, valor:valor, ordem_id:ordem_id},
           success:function(data){
            if(data.message.type == 'success') {
                toastr.success(data.message.message);
                $("#form_pecas").trigger('reset')
            } else {
                toastr.error(data.message.message);
            }
           },
           error: function (data) {
            console.log(data)
            }
        });

    });
</script>
@endsection
