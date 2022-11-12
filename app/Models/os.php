<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Os extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'tipo_aparelho',
        'marca_id',
        'modelo',
        'estado_aparelho',
        'defeito_alegado',
        'observacao',
        'valor_servico',
        'entregue_para'
    ];

    protected $table = 'ordens';
}
