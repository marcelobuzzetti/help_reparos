@extends('layouts.app')

@section('content')
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
            </tr>
        </tfoot>
    </table>
</div>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
@endsection
