<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas =  Marca::all();
        return $marcas;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $marca = Marca::create($request->all());
        return $marca;
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        return $marca;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        /*print_r($request->all()); // os dados atualizados
        echo '<hr>';
        print_r($marca->getAttributes()); // os dados antigos
        */

        $marca->update($request->all());
        return $marca;

        /*  Diferença entre PUT E PATCH:
            PUT: atualiza todo o recurso, mesmo os campos que não foram alterados, ou seja, se um campo não for enviado na requisição, ele será atualizado para null.
            PATCH: atualiza apenas os campos que foram alterados, ou seja, se um campo
            não for enviado na requisição, ele não será atualizado.
        */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        $marca->delete();
        //print_r($marca->getAttributes()); // os dados antigos
        // getAttributes() é um método do Eloquent que retorna um array com os atributos atuais/alterados do modelo, ou seja, os dados do registro no banco de dados.
        return ['msg' => 'Marca deletada com sucesso!'];
    }
}
