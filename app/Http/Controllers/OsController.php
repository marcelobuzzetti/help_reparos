<?php

namespace App\Http\Controllers;

use App\Models\Os;
use App\Models\Cliente;
use App\Models\Marca;
use App\Models\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $request->validate([
            'clienteNome' => 'required|exists:clientes,nome',
            'marcaDescricao' => 'required|exists:marcas,descricao',
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_aparelho' => 'required|min:3',
            'marca_id' => 'required|exists:marcas,id',
            'status_id' => 'required|exists:status,id',
            'modelo' => 'required|min:3',
            'estado_aparelho' => 'required|min:3',
            'defeito_alegado' => 'required|min:10',
            /* 'observacao' => 'required', */
        ]);

        $clienteNome = $request->old('clienteNome');
        $cliente_id = $request->old('cliente_id');
        $tipo_aparelho = $request->old('tipo_aparelho');
        $marca_id = $request->old('marca_id');
        $status_id = $request->old('status_id');
        $modelo = $request->old('modelo');
        $estado_aparelho = $request->old('estado_aparelho');
        $defeito_alegado = $request->old('defeito_alegado');
        $observacao = $request->old('observacao');

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

        $request->validate([

            'cliente_id' => 'required|exists:clientes,id',
            'tipo_aparelho' => 'required|min:3',
            'marca_id' => 'required|exists:marcas,id',
            'status_id' => 'required|exists:status,id',
            'modelo' => 'required|min:3',
            'estado_aparelho' => 'required|min:3',
            'defeito_alegado' => 'required|min:10',

            'valor_servico' => 'required',
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

        try {
            Os::osUpdate($request->all());
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

    public function orcamentoStore(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:ordens,id',
            'valor_servico' => 'required|numeric',
            'status_id' => 'required|exists:status,id',
        ]);

        $valor_servico = $request->old('valor_servico');
        $status_id = $request->old('status_id');

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
    }

    public function entrega(Request $request)
    {


        $request->validate([
            'id' => 'required|exists:ordens,id',
            'entregue_para' => 'required|min:3',
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
}
