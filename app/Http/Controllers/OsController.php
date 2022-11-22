<?php

namespace App\Http\Controllers;

use App\Models\Os;
use App\Models\Cliente;
use App\Models\Marca;
use App\Models\Status;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OsController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $ordens = Os::osMarcaCliente(); */
        $ordem = new Os;
        $ordens = $ordem->with(['Cliente','Marca','Status'])->get();

        return view('ordem.index', [
            'ordens' => $ordens
        ]);

        /*
        Com paginação

        $clientes = Cliente::latest()->paginate(5);

        return view('cliente.index',compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * 5); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('ordem.create', [
            'marcas' => Marca::all(),
            'clientes' => Cliente::all(),
            'status' => Status::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->valor_servico ? $request['is_orcado'] = TRUE : $request['is_orcado'] = FALSE;

        $request->valor_servico ? $request['valor_servico'] = Os::currencyToDecimal($request->valor_servico) : null;

        $request->validate([
            'clienteNome' => 'required|exists:clientes,nome',
            'marcaDescricao' => 'required|exists:marcas,descricao',
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_aparelho' => 'required',
            'marca_id' => 'required|exists:marcas,id',
            'status_id' => 'required|exists:status,id',
            'modelo' => 'required',
            'estado_aparelho' => 'required',
            'defeito_alegado' => 'required',
            /* 'observacao' => 'required', */
        ]);

        $clienteNome = $request->old('clienteNome');
        $marcaDescricao = $request->old('marcaDescricao');
        $cliente_id = $request->old('cliente_id');
        $tipo_aparelho = $request->old('tipo_aparelho');
        $marca_id = $request->old('marca_id');
        $status_id = $request->old('status_id');
        $modelo = $request->old('modelo');
        $estado_aparelho = $request->old('estado_aparelho');
        $defeito_alegado = $request->old('defeito_alegado');
        $observacao = $request->old('observacao');
        $laudo_tecnico = $request->old('laudo_tecnico');

        try {
            $os = Os::create($request->all());
            $osId = $os->id;
            $message = [
                "type" => "success",
                "message" => "Ordem de Serviço nº $osId foi criada com sucesso!!!."
            ];
        } catch (Exception $e) {
            $message = [
                "type" => "error",
                "message" => $e->getMessage()
            ];
        }

        return redirect()->route('ordens.index')
                        ->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Os  $ordem
     * @return \Illuminate\Http\Response
     */
    public function show($os)
    {
        $ordem = new Os;
        $ordem = $ordem->with(['Cliente','Marca','Status'])->findOrFail($os);
        return view('ordem.show',compact('ordem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Os  $ordem
     * @return \Illuminate\Http\Response
     */
    public function edit($os)
    {
        $ordem = new Os;
        $ordem = $ordem->with(['Cliente','Marca','Status'])->findOrFail($os);
        $ordem->valor_servico ? $ordem->valor_servico = Os::decimalToCurrency($ordem->valor_servico) : null;

        $clientes = Cliente::all();
        $marcas = Marca::all();
        $status = Status::all();
        return view('ordem.edit',[
            'ordem' => $ordem,
            'clientes' => $clientes,
            'marcas' => $marcas,
            'status' => $status
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Os  $ordem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Os $ordem)
    {
        $os = new Os;
        $os = $os->findOrFail($request->id);

        if(!$os->is_orcado){
            $request->valor_servico ? $request['is_orcado'] = TRUE : $request['is_orcado'] = FALSE;
        }

        $request->valor_servico ? $request['valor_servico'] = Os::currencyToDecimal($request->valor_servico) : null;

        $request->validate([
            'clienteNome' => 'required|exists:clientes,nome',
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_aparelho' => 'required',
            'marcaDescricao' => 'required|exists:marcas,descricao',
            'marca_id' => 'required|exists:marcas,id',
            'status_id' => 'required|exists:status,id',
            'modelo' => 'required',
            'estado_aparelho' => 'required',
            'defeito_alegado' => 'required',
        ]);


        $cliente_id = $request->old('cliente_id');
        $tipo_aparelho = $request->old('tipo_aparelho');
        $marca_id = $request->old('marca_id');
        $status_id = $request->old('status_id');
        $modelo = $request->old('modelo');
        $estado_aparelho = $request->old('estado_aparelho');
        $defeito_alegado = $request->old('defeito_alegado');
        $observacao = $request->old('observacao');
        $valor_servico = $request->old('valor_servico');
        $laudo_tecnico = $request->old('laudo_tecnico');


        try {
            $os->update($request->all());
            $message = [
                "type" => "success",
                "message" => "OS Nº $request->id atualizada com sucesso!!!"
            ];
        } catch (Exception $e) {
            $message = [
                "type" => "error",
                "message" => $e->getMessage()
            ];
        }

        return redirect()->route('ordens.index')
                        ->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Os  $ordem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ordem = new Os;

        try{
            $ordem::where('id', $id)->delete();
            $message = [
                "type" => "success",
                "message" => "Ordem Nº $id foi apagada com sucesso!!!"
            ];
         } catch (Exception $e) {
            if(stripos($e->getMessage(), 'FOREIGN KEY')) {
                $message = [
                    "type" => "error",
                    "message" => "Não é possível excluir a Ordem de Serviço!!!"
                ];
            } else {
                $message = [
                    "type" => "error",
                    "message" => $e->getMessage()
                ];
            }
        }

        return redirect()->route('ordens.index')
                        ->with('message', $message);
    }

    public function entregaShow($id)
    {
        $ordem = new Os;
        $ordem = $ordem->with(['Cliente','Marca','Status'])->findOrFail($id);
        $clientes = Cliente::all();
        $marcas = Marca::all();
        $status = Status::all();
        return view('ordem.entrega',[
            'ordem' => $ordem,
            'status' => $status
        ]);
    }

    public function orcamento($os)
    {
        $ordem = new Os;
        $ordem = $ordem->with(['Cliente','Marca','Status'])->findOrFail($os);

        return view('ordem.orcamento',[
            'ordem' => $ordem,
        ]);
    }

    public function orcamentoStore(Request $request)
    {
        $request['valor_servico'] = floatval(preg_replace('/[^\d\.]/', '', $request->valor_servico));

        $request->validate([
            'id' => 'required|exists:ordens,id',
            'valor_servico' => 'required',
            'email' => 'required|exists:users,email',
            'password' => 'required',

        ]);

        $valor_servico = $request->old('valor_servico');

        $user = User::where('email', $request['email'])
        ->where('is_admin', 1)
        ->first();

        $user ? $validCredentials = Hash::check($request['password'], $user->getAuthPassword()) : $validCredentials = FALSE;

        if ($validCredentials)
        {

            $ordem = new Os;
            $ordem = $ordem->findOrFail($request->id);

            try {
                $ordem->update($request->all());
                $message = [
                    "type" => "success",
                    "message" => "Ordem de Serviço nº $request->id foi Orçada!!!."
                ];
            } catch (Exception $e) {
                $message = [
                    "type" => "error",
                    "message" => $e->getMessage()
                ];
            }

            return redirect()->route('ordens.index')
                            ->with('message', $message);

        } else  {

            return back()->withErrors([
                'email' => 'Usuário e/ou Senha errados',
                'password' => 'Usuário e/ou Senha errados'
            ]);

        }


    }

    public function entrega(Request $request)
    {


        $request->validate([
            'id' => 'required|exists:ordens,id',
            'entregue_para' => 'required',
     /*        'status_id' => 'required|exists:status,id', */
        ]);

        $entregue_para = $request->old('entregue_para');
        $status_id = $request->old('status_id');
        $data = $request->all();
        /* $ordem = new Os;
        $ordem = $ordem->findOrFail($request->id); */

        $date = date('Y-m-d');

        /* $ordem->update($data); */

        try {
            DB::table('ordens')
              ->where('id', $data['id'])
              ->update(['entregue_para' => $data['entregue_para'],
            /* 'status_id' => $data['status_id'], */
            'retirada' => $date,
            'status_id' => 5
        ]   );
            $message = [
                "type" => "success",
                "message" => "Ordem de Serviço nº $request->id entregue para $request->entregue_para!!!."
            ];
        } catch (Exception $e) {
            $message = [
                "type" => "error",
                "message" => $e->getMessage()
            ];
        }

        return redirect()->route('ordens.index')
                        ->with('message', $message);
    }

    /* public function showTeste($id)
    {
        $ordem = json_decode(json_encode(Os::osId($id)), true);
        return view('ordem.show',[
            'ordem' => $ordem
        ]);
    }

    public function editTeste($id)
    {
        $ordem = json_decode(json_encode(Os::osId($id)), true);
        $clientes = Cliente::all();
        $marcas = Marca::all();
        return view('ordem.edit',[
            'ordem' => $ordem,
            'clientes' => $clientes,
            'marcas' => $marcas
        ]);
    }

    public function destroyTeste($id)
    {
        $ordem = Os::find($id);
        $id = $ordem->id;
        $ordem->delete();

        return redirect()->route('ordens.index')
        ->with('success',"OS Nº $id apagada com sucesso!!!");
    } */

    public function buscarOs(Request $request)
    {
        $request->validate([
            'buscaOS' => 'required|exists:ordens,id',
        ]);

        $buscaOS = $request->old('buscaOS');

        return redirect()->route('ordens.show', $request->buscaOS);
    }

    public function imprimirOs(Request $request)
    {
        $ordem = new Os;
        $ordem = $ordem->with(['Cliente','Marca','Status'])->findOrFail($request->id);
        return view('ordem.show',compact('ordem'))->with('print', TRUE);
    }
}
