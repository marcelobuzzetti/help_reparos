<?php

namespace App\Http\Controllers;

use App\Models\Os;
use App\Models\Cliente;
use App\Models\Marca;
use Illuminate\Http\Request;

class OsController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordens = Os::osMarcaCliente();

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
            'clientes' => Cliente::all()
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
            'modelo' => 'required|min:3',
            'estado_aparelho' => 'required|min:3',
            'defeito_alegado' => 'required|min:10',
            'observacao' => 'required',
        ]);

        $cliente_id = $request->old('cliente_id');
        $tipo_aparelho = $request->old('tipo_aparelho');
        $marca_id = $request->old('marca_id');
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
    public function show(Os $ordem)
    {
        return view('ordem.show',compact('ordem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Os  $ordem
     * @return \Illuminate\Http\Response
     */
    public function edit(Os $ordem)
    {
        return view('ordem.edit',compact('ordem'));
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
            'descricao' => 'required|max:255|min:3'
        ]);

        $descricao = $request->old('descricao');

        $descricaoPOST = $request->descricao;
        $ordem->update($request->all());

        return redirect()->route('ordens.index')
                        ->with('success',"Cliente $descricaoPOST atualizado com sucesso!!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Os  $ordem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Os $ordem)
    {
        $id = $ordem->id;
        $ordem->delete();

        return redirect()->route('ordens.index')
                        ->with('success', "Ordem Nº $id foi apagada com sucesso!!!");
    }

    public function showTeste($id)
    {
        $ordem = json_decode(json_encode(Os::osId($id)), true);
        return view('ordem.show',[
            'ordem' => $ordem
        ]);
    }
}
