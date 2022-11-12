<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Os extends Model
{
    use HasFactory;

    protected $fillable = [
        'entrada',
        'tipo_aparelho',
        'marca',
        'modelo',
        'estado_aparelho',
        'defeito_alegado',
        'observação',
        'valor_servico',
        'retirada',
        'entregue_para'
    ];

    protected $table = 'os';
}
