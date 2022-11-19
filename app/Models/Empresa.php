<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_empresa',
        'endereco',
        'telefone',
        'email',
        'facebook',
        'whatsapp',
    ];

    protected $table = 'empresas';
}
