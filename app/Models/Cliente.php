<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'telefone',
        'rg',
        'cpf',
        'email',
        'endereco'
    ];

    protected $table = 'clientes';

    public function os()
    {
        return $this->belongsTo(Os::class, 'cliente_id', 'id');
    }
}
