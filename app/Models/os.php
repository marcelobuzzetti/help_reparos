<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function osMarcaCliente(){
        return DB::table('ordens')
            ->join('marcas', 'ordens.marca_id', '=', 'marcas.id')
            ->join('clientes', 'ordens.cliente_id', '=', 'clientes.id')
            ->select('ordens.*', 'clientes.nome AS nome', 'marcas.descricao AS marca')
            ->get();
    }

    public static function osId($id){
        $ordemId = $id;
        $res = DB::table('ordens')
            ->join('marcas', 'ordens.marca_id', '=', 'marcas.id')
            ->join('clientes', 'ordens.cliente_id', '=', 'clientes.id')
            ->select('ordens.*', 'clientes.nome AS nome', 'marcas.descricao AS marca')
            ->where('ordens.id', '=', $ordemId)
            ->get()->toArray();
        return $res;
    }
}
