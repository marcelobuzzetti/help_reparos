<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Os;
use App\Models\Peca;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descricao' => 'required',
            'valor' => 'required',
            'ordem_id' => 'required',
        ]);

        if ($validator->fails()) {
            $message = [
                "type" => "error",
                "message" => $validator->errors()->all()
            ];

            return response()->json(['message' => $message]);
        }

        try {
            $peca = Peca::create($request->all());
            $pecaId = $peca->id;
            $message = [
                "type" => "success",
                "message" => "Peça adicionada a Ordem de Serviço nº $peca->ordem_id!!!."
            ];
        } catch (Exception $e) {
            $message = [
                "type" => "error",
                "message" => $e->getMessage()
            ];
        }

        return response()->json(['message' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pecas = new Peca();
        $pecas = $pecas->where('ordem_id','=', $id)->get();
        return view('peca.create',[
            'ordem_id' => $id,
            'pecas' => $pecas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
