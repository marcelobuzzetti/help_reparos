<?php

namespace App\Http\Controllers;

use App\Models\Os;
use App\Models\Cliente;
use App\Models\Marca;
use App\Models\Status;
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
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_aparelho' => 'required|min:3',
            'marca_id' => 'required|exists:marcas,id',
            'status_id' => 'required|exists:status,id',
            'modelo' => 'required|min:3',
            'estado_aparelho' => 'required|min:3',
            'defeito_alegado' => 'required|min:10',
            'observacao' => 'required',
        ]);

        $cliente_id = $request->old('cliente_id');
        $tipo_aparelho = $request->old('tipo_aparelho');
        $marca_id = $request->old('marca_id');
        $status_id = $request->old('status_id');
        $modelo = $request->old('modelo');
        $estado_aparelho = $request->old('estado_aparelho');
        $defeito_alegado = $request->old('defeito_alegado');
        $observacao = $request->old('observacao');

        $os = Os::create($request->all());
        $osId = $os->id;

        return redirect()->route('ordens.index')
                        ->with('success',"Ordem de Serviço nº $osId foi criada com sucesso!!!.");
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
            'observacao' => 'required',
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

        Os::osUpdate($request->all());

        return redirect()->route('ordens.index')
                        ->with('success',"OS Nº $request->id atualizada com sucesso!!!");
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
        $ordem::where('id', $id)->delete();

        return redirect()->route('ordens.index')
                        ->with('success', "Ordem Nº $id foi apagada com sucesso!!!");
    }

    public function orcamento($id)
    {
        $ordem = new Os;
        $ordem = $ordem->with(['Cliente','Marca','Status'])->findOrFail($id);
        $clientes = Cliente::all();
        $marcas = Marca::all();
        $status = Status::all();
        return view('ordem.orcamento',[
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
        $ordem->update($request->all());

        return redirect()->route('ordens.index')
                        ->with('success',"Ordem de Serviço nº $request->id foi Orçada!!!.");
    }

    public function entrega(Request $request)
    {


        $request->validate([
            'id' => 'required|exists:ordens,id',
            'entregue_para' => 'required|min:3',
            'status_id' => 'required|exists:status,id',
        ]);

        $entregue_para = $request->old('entregue_para');
        $status_id = $request->old('status_id');
        $data = $request->all();
        /* $ordem = new Os;
        $ordem = $ordem->findOrFail($request->id); */

        $date = date('Y-m-d H:i:s');

        DB::table('ordens')
              ->where('id', $data['id'])
              ->update(['entregue_para' => $data['entregue_para'],
            'status_id' => $data['status_id'],
            'retirada' => $date,
            'status_id' => 5
        ]);

        /* $ordem->update($data); */

        return redirect()->route('ordens.index')
                        ->with('success',"Ordem de Serviço nº $request->id entregue para $request->entregue_para!!!.");
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
