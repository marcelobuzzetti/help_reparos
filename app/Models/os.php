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

    public function cliente()
    {
        return $this->hasMany(Cliente::class, 'id', 'cliente_id');
    }

    public function marca()
    {
        return $this->hasMany(Marca::class, 'id', 'marca_id');
    }

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

    public static function osUpdate($request){
        DB::table('ordens')
        ->where('id', $request['id'])
        ->update([
            'cliente_id' => $request['cliente_id'],
            'tipo_aparelho' => $request['tipo_aparelho'],
            'marca_id' => $request['marca_id'],
            'modelo' => $request['modelo'],
            'estado_aparelho' => $request['estado_aparelho'],
            'defeito_alegado' => $request['defeito_alegado'],
            'observacao' => $request['observacao'],
            'valor_servico' => $request['valor_servico']
        ]);
    }
}
