@extends('layouts.app')

@section('content')
    <div class="card-glass">
        <div class="text-center">
            <h2>Balanço do corrente mês ({{ Str::upper($data) }})</h2>
            <h3 class="text-success"><i class="icofont-bank"></i> R${{ sprintf('%0.2f', $balanco) }} <i class="icofont-bank"></i></h3>
            <h4 class="text-success">Total Recebido R${{ sprintf('%0.2f', $totalOrcamentos) }} <i class="icofont-arrow-up"></i></h4>
            <h4 class="text-danger">Total Despesas R${{ sprintf('%0.2f', $totalPecas) }} <i class="icofont-arrow-down"></i></h4>
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
        @if (isset($balancoGerado))
        <div class="text-center">
            <h2>Balanço do período de {{ $dataInicio }} a {{ $dataFim }}</h2>
            <h3 class="text-success"><i class="icofont-bank"></i> R${{ sprintf('%0.2f', $balancoGerado) }} <i class="icofont-bank"></i></h3>
            <h4 class="text-success">Total Recebido R${{ sprintf('%0.2f', $totalOrcamentosGerado) }} <i class="icofont-arrow-up"></i></h4>
            <h4 class="text-danger">Total Despesas R${{ sprintf('%0.2f', $totalPecasGerado) }} <i class="icofont-arrow-down"></i></h4>
        </div>
        @endif
    </div>


    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                fixedHeader: {
                    headerOffset: 60
                },
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 linhas', '25 linhas', '50 linhas', 'Mostrar tudo']
                ],
                language: {
                    buttons: {
                        pageLength: {
                            _: "Mostrar %d linhas",
                            '-1': "Mostrar todos"
                        }
                    }
                },
                buttons: [
                    "pageLength",
                    {
                        extend: 'copyHtml5',
                        text: 'Cópia',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'colvis',
                        text: 'Colunas Visíveis',

                    },
                    {
                        className: 'btn-export border-0 btn-outline-export',
                        text: "<a class='btn btn-primary' href='/clientes/create'>Criar Cliente</a>",
                        action: function ( e, dt, button, config ) {
                            window.location = `<?php echo env('APP_URL'); ?>/clientes/create`;
                        }
                    },
                ],
                /* buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ], */
                "oLanguage": {
                    "sSearch": "Buscar: ",
                    "sProcessing": "Aguarde enquanto os dados são carregados ...",
                    "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
                    "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
                    "sInfoFiltered": "",
                    "oPaginate": {
                        "sFirst": "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext": "Próximo",
                        "sLast": "Último"
                    }
                }
            });

            const exampleModal = document.getElementById('exampleModal')
            exampleModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const nome = button.getAttribute('data-bs-nome')
                const id = button.getAttribute('data-bs-id')
                // If necessary, you could initiate an AJAX request here
                // and then do the updating in a callback.
                //
                // Update the modal's content.
                const modalTitle = exampleModal.querySelector('.modal-title')
                const modalBodyForm = document.getElementById('apagarCliente')
                const modalBodyNomeCliente = document.getElementById('nomeClienteModal')

                modalTitle.textContent = `Apagar Cliente ${nome}`
                modalBodyNomeCliente.textContent = nome
                modalBodyForm.action = `<?php echo env('APP_URL'); ?>/clientes/${id}`
            })
        });
    </script>
@endsection
