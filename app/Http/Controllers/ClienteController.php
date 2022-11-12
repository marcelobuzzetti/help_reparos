<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cliente.index', [
            'clientes' => Cliente::all()
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
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nome = $request->nome;

        $request->validate([
            'nome' => 'required|max:255|min:3',
            'telefone' => 'required|numeric',
            'rg' => 'required|numeric',
            'cpf' => 'required|cpf',
            'email' => 'required|email',
            'endereco' => 'required|min:10',
        ]);

        $nome = $request->old('nome');
        $telefone = $request->old('telefone');
        $rg = $request->old('rg');
        $cpf = $request->old('cpf');
        $email = $request->old('email');
        $endereco = $request->old('endereco');

        Cliente::create($request->all());

        return redirect()->route('clientes.index')
                        ->with('success','Cliente $nome criado com sucesso!!!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('cliente.show',compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $nome = $cliente->nome;
        $cliente->delete();

        return redirect()->route('clientes.index')
                        ->with('success', $nome);
    }
}
