@extends('layouts.app')

@section('content')

@if ($message = Session::get('apagado'))
{{--     <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div> --}}
    <script>
        toastr.success('Cliente apagado com sucesso!!!');
    </script>
@endif


<div class="container">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefon</th>
                <th>RG</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @if ($clientes)

            @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>{{ $cliente->rg }}</td>
                <td>{{ $cliente->cpf }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->endereco }}</td>
                <td>
                    <div class="d-flex flex-wrap">
                        <form action="{{ route('clientes.destroy',$cliente->id) }}" method="POST">
                            <div class="p-2">
                                <a class="btn btn-info flex-grow-1" href="{{ route('clientes.show',$cliente->id) }}">Motrar</a>
                            </div>
                            <div class="p-2">
                                <a class="btn btn-primary flex-grow-1" href="{{ route('clientes.edit',$cliente->id) }}">Editar</a>
                            </div>
                            <div class="p-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger flex-grow-1">Apagar</button>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach

            @endif
        </tbody>
        <tfoot>
            <tr>
                <th>Nome</th>
                <th>Telefon</th>
                <th>RG</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </tfoot>
    </table>
</div>
<script>
    $(document).ready(function () {
        $('#example').DataTable();

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    });
</script>
@endsection
