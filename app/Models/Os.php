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
        'entregue_para',
        'status_id'

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

    public function status()
    {
        return $this->hasMany(Status::class, 'id', 'status_id');
    }

    public static function osUpdate($request){
        DB::table('ordens')
        ->where('id', $request['id'])
        ->update([
            'cliente_id' => $request['cliente_id'],
            'tipo_aparelho' => $request['tipo_aparelho'],
            'marca_id' => $request['marca_id'],
            'status_id' => $request['status_id'],
            'modelo' => $request['modelo'],
            'estado_aparelho' => $request['estado_aparelho'],
            'defeito_alegado' => $request['defeito_alegado'],
            'valor_servico' => $request['valor_servico'],
            'observacao' => $request['observacao'],
            'valor_servico' => $request['valor_servico']
        ]);
    }
}