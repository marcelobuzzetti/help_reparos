@extends('layouts.app')

@section('content')
    <div class="card-glass">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $key => $user)
                    <tr style="text-align: center">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="d-flex flex-wrap justify-content-around">
                                <div class="p-2">
                                    <a class="btn btn-info flex-inline flex-grow-1"
                                        href="{{ route('usuarios.show', $user->id) }}"><i class="icofont-search-1"></i>
                                        Motrar</a>
                                </div>
                                <div class="p-2">
                                    <a class="btn btn-primary flex-inline flex-grow-1"
                                        href="{{ route('usuarios.edit', $user->id) }}"><i class="icofont-ui-edit"></i>
                                        Editar</a>
                                </div>
                                <div class="p-2">
                                    <button class="btn btn-danger flex-inline flex-grow-1" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-bs-nome="{{ $user->name }}"
                                        data-bs-id="{{ $user->id }}"><i class="icofont-ui-delete"></i> Apagar</button>
                                </div>
                            </div>
                        </td>
                    </tr>
            </tbody>
            @endforeach
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="apagarCliente" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <p>Tem certeza que deseja apagar <strong class="fs-3"><span
                                        id="nomeClienteModal"></span></strong>?</p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary d-flex-inline" data-bs-dismiss="modal"><i
                            class="icofont-close"></i> Fechar</button>
                    <button type="submit" class="btn btn-danger d-flex-inline"><i class="icofont-ui-delete"></i>
                        Apagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                columnDefs: [{
                        type: 'date-euro',
                        targets: 2
                    },
                    {
                        "className": "align-middle",
                        "targets": "_all"
                    }
                ],
                fixedHeader: {
                    headerOffset: 60
                },
                "order": [0, 'desc'],
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
                buttons: ["pageLength",],
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

                modalTitle.textContent = `Apagar Usuário ${nome}`
                modalBodyNomeCliente.textContent = nome
                modalBodyForm.action = `<?php echo env('APP_URL'); ?>/usuarios/${id}`
            })
        });
    </script>
@endsection