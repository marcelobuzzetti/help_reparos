<?php

namespace App\Http\Controllers;

use App\Models\Os;
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
        return view('ordem.index', [
            'ordens' => Os::all()
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
        return view('ordem.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $descricaoPOST = $request->descricao;

        $request->validate([
            'descricao' => 'required|max:255|min:3'
        ]);

        $descricao = $request->old('descricao');

        Marca::create($request->all());

        return redirect()->route('marcas.index')
                        ->with('success',"Marca $descricaoPOST criada com sucesso!!!.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        return view('marca.show',compact('marca'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        return view('marca.edit',compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {

        $request->validate([
            'descricao' => 'required|max:255|min:3'
        ]);

        $descricao = $request->old('descricao');

        $descricaoPOST = $request->descricao;
        $marca->update($request->all());

        return redirect()->route('marcas.index')
                        ->with('success',"Cliente $descricaoPOST atualizado com sucesso!!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        $descricao = $marca->descricao;
        $marca->delete();

        return redirect()->route('marcas.index')
                        ->with('success', "Marca $descricao apagada com sucesso!!!");
    }
}
