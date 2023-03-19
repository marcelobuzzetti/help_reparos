Dados da Ordem de Serviço -
Dados Cadastrados: -
Entrada: {{ date('d/m/Y', strtotime($ordem->entrada)) }} -
Tipo de Aparelho: {{ $ordem->tipo_aparelho }}  -
Marca: {{ $ordem->marca->descricao }}  -
Modelo {{ $ordem->modelo }} -
Estado do Aparelho {{ $ordem->estado_aparelho }} -
Defeito Alegado {{ $ordem->defeito_alegado }} -
Acessórios: {{ $ordem->acessorios }} -
Valor do Serviço: {{ $ordem->valor_servico ? $ordem->valor_servico : 'Ainda não Orçado'}} -
Status {{ $ordem->status->descricao }} -
@if($ordem->retirada)
    Retirada: {{ date('d/m/Y', strtotime($ordem->retirada)) }} -
    Entregue para: {{ $ordem->entregue_para }}
@endif
