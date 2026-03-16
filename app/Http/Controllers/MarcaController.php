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
        // Listar todos os regitros;
        $marcas = $this->marca->all(); // usando a instância do objeto
        // $marcas =  Marca::all(); // não fazemos a instância do objeto
        return response()->json($marcas,200);
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
        // Criar um novo registro;
        // $marca = Marca::create($request->all()); // não fazemos a instância do objeto
        // nome
        // imagem


        $request->validate($this->marca->rules(), $this->marca->feedback());
        $marca = $this->marca->create($request->all()); // usando a instância do objeto
        return response()->json($marca, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mostrar os dados de um registro esoecífico
        $marca = $this->marca->find($id); // usando a instância do objeto
        if($marca == null){
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404); // json
        }
        return response()->json($marca,200); // sugestão de tipo
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
        // Atualizar dados de um registro existente;

        /*print_r($request->all()); // os dados atualizados
        echo '<hr>';
        print_r($marca->getAttributes()); // os dados antigos
        */

        //$marca->update($request->all());
        $marca = $this->marca->find($id); // usando a instância do objeto

        if($marca == null){
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'],404);
        }

        if($request->method() == 'PATCH') {
            return ['teste' => 'Verbo PATCH'];

            $regrasDinamicas = array();
            //percorrendo todas as regras definidas no Model
            foreach($marca->rules() as $input => $regra){
                // coletar apenas as regras aplicadas aos parâmetros parciais da requisição PATCH

                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            dd($regrasDinamicas());

            $request->validate($regrasDinamicas, $marca->feedback());
        } else {
            $request->validate($marca->rules(), $marca->feedback());
        }

        $request->validate($marca->rules(), $marca->feedback());

        $marca->update($request->all());
        return response()->json($marca,200); // sugestão de tipo


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
        if($marca == null){
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'],404);
        } 
        $marca->delete();
        //print_r($marca->getAttributes()); // os dados antigos
        // getAttributes() é um método do Eloquent que retorna um array com os atributos atuais/alterados do modelo, ou seja, os dados do registro no banco de dados.
        return response()->json(['msg' => 'Marca deletada com sucesso!'],200);
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
Isso ajuda a garantir que os dados sejam do tipo cor?reto, 
evitando erros e melhorando a legibilidade do código.
No exemplo acima, a sugestão de tipo "Marca" indica que
o parâmetro $marca deve ser uma instância da classe Marca, e o
retorno da função show() também deve ser do tipo Marca.



O que é o Accept?
É um cabeçalho(header) da requisição HTTP que informa ao servidor qual 
formato de resposta o cliente deseja receber. 
Ex:
GET /produtos
Accept: application/json
{
  "id": 1,
  "nome": "Coca-Cola"
}



GET /produtos
Accept: application/xml
<produto>
  <id>1</id>
  <nome>Coca-Cola</nome>
</produto>


Rules -> São regras de validação de dados. Elas definem o que é permitido
ou não quando alguém envia dados para o sistema.
As rules garantem que os dados estejam corretos antes de serem salvos no banco.

*/ 