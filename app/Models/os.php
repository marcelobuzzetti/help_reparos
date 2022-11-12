<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Os extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_aparelho',
        'marca',
        'modelo',
        'estado_aparelho',
        'defeito_alegado',
        'observacao',
        'valor_servico',
        'entregue_para'
    ];

    protected $table = 'ordens';
}
