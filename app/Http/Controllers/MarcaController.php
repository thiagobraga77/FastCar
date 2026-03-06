<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }
    // O trecho de código acima é um construtor da classe MarcaController. Ele recebe 
    // uma instância da classe Marca como
    //  parâmetro e a atribui à propriedade
    //  $marca do controlador. Isso permite 
    // que o controlador tenha acesso à instância do modelo
    //  Marca para realizar operações de banco de dados, como
    //  criar, atualizar ou deletar registros relacionados a marcas.

    /**
     * Display a listing of the resource.
     */
    public function index(Marca $marca)
    {
        $marcas = $this->marca->all(); // usando a instância do objeto
        // $marcas =  Marca::all(); // não fazemos a instância do objeto
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
        // $marca = Marca::create($request->all()); // não fazemos a instância do objeto
        $marca = $this->marca->create($request->all()); // usando a instância do objeto
        return $marca; 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $marca = $this->marca->find($id); // usando a instância do objeto
        return $marca; // sugestão de tipo
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
    public function update(Request $request, $id)
    {
        /*print_r($request->all()); // os dados atualizados
        echo '<hr>';
        print_r($marca->getAttributes()); // os dados antigos
        */

        //$marca->update($request->all());
        $marca = $this->marca->find($id); // usando a instância do objeto
        $marca->update($request->all());
        return $marca;

        //Para que serve o find?
        //O método find() é usado para buscar um registro específico no banco de dados com base em seu ID. Ele retorna uma instância do modelo correspondente ao registro encontrado ou null se nenhum registro for encontrado com o ID fornecido. No exemplo acima, $this->marca->find($id) busca a marca com o ID especificado e retorna a instância do modelo Marca correspondente a esse registro.
        /*  Diferença entre PUT E PATCH:
            PUT: atualiza todo o recurso, mesmo os campos que não foram alterados, ou seja, se um campo não for enviado na requisição, ele será atualizado para null.
            PATCH: atualiza apenas os campos que foram alterados, ou seja, se um campo
            não for enviado na requisição, ele não será atualizado.
        */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $marca = $this->marca->find($id); // usando a instância do objeto
        $marca->delete();
        //print_r($marca->getAttributes()); // os dados antigos
        // getAttributes() é um método do Eloquent que retorna um array com os atributos atuais/alterados do modelo, ou seja, os dados do registro no banco de dados.
        return ['msg' => 'Marca deletada com sucesso!'];
    }
}

/*
Index(): Estático;
Store(): Estático;
Show(): Dinâmico -  Sugestão de tipo;
Update(): Dinâmico - Sugestão de tipo;
Destroy(): Dinâmico - Sugestão de tipo;

O que é sugestão de tipo?
A sugestão de tipo é uma prática de programação que 
consiste em indicar o tipo de dado esperado.

O que é Type Hinting? 
Type Hinting é um recurso do PHP que permite especificar o 
tipo de dado esperado para um parâmetro ou o tipo 
de dado retornado por uma função ou método. 
Isso ajuda a garantir que os dados sejam do tipo correto, 
evitando erros e melhorando a legibilidade do código.
No exemplo acima, a sugestão de tipo "Marca" indica que
o parâmetro $marca deve ser uma instância da classe Marca, e o
retorno da função show() também deve ser do tipo Marca.
*/