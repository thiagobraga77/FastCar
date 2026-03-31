<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Listar todos os regitros;
         // usando a instância do objeto
        // $modelos =  modelo::all(); // não fazemos a instância do objeto

        $modelos = array();

        if($request->has('atributos_marca')){
            $atributos_marca = $request->atributos_marca;
            $modelos = $this->modelo->with('marca:id'.$atributos_marca);
        } else {
            $modelos = $this->modelo->with('marca');
        }

        if($request->has('filtro')) {
            $condicoes = explode(':', $request->filtro);
            $modelos = $modelos->where($condicoes[0], $condicoes[1], $condicoes[2]);
            
        }
        
        if($request->has('atributos')){
            $atributos = $request->atributos;
            $modelos = $modelos->selectRaw($atributos)->get();
        } else {
            $modelos = $modelos->get();
        }

        return response()->json($this->modelo->with('marca')->get(),200);
        
        // all() -> criando um obj de consulta + get() = collection
        // get() -> modificar a consulta -> collection
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
        $request->validate($this->modelo->rules(), $this->modelo->feedback());
        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/modelos', 'public');

        dd($imagem_urn);

        $modelo = $this->modelo->create([
            'marca_id' => $request->marca_id,
            'nome' => $request->nome,
            'imagem' => $imagem_urn,
            'numero_portas' => $request->numero_portas,
            'lugares' => $request->lugares,
            'air_bag' => $request->air_bag,
            'abs' => $request->abs,
            ]); // usando a instância do objeto

        return response()->json($modelo, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $modelo = $this->modelo->with('marca')->find($id); // usando a instância do objeto
        if($modelo == null){
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404); // json
        }
        return response()->json($modelo,200); // sugestão de tipo
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modelo $modelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $modelo = $this->modelo->find($id); // usando a instância do objeto

        if($modelo == null){
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'],404);
        }

        if($request->method() == 'PATCH') {
            return ['teste' => 'Verbo PATCH'];

            $regrasDinamicas = array();
            //percorrendo todas as regras definidas no Model
            foreach($modelo->rules() as $input => $regra){
                // coletar apenas as regras aplicadas aos parâmetros parciais da requisição PATCH

                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            dd($regrasDinamicas());

            $request->validate($regrasDinamicas, $modelo->feedback());
        } else {
            $request->validate($modelo->rules(), $modelo->feedback());
        }
        // remove o arquivo antigo caso um novo arquivo tenha sido enviado no request
        if($request->file('imagem')){
            Storage::disk('public')->delete($modelo->imagem);
        }

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/modelos', 'public');

        $modelo->fill($request->all());
        $modelo->imagem = $imagem_urn;
        $modelo->save();
        
        /*
        $modelo->update([
            'marca_id' => $request->marca_id,
            'nome' => $request->nome,
            'imagem' => $imagem_urn,
            'numero_portas' => $request->numero_portas,
            'lugares' => $request->lugares,
            'air_bag' => $request->air_bag,
            'abs' => $request->abs,
        ]);
        */

        $request->validate($modelo->rules(), $modelo->feedback());

        $modelo->update($request->all());
        return response()->json($modelo,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $modelo = $this->modelo->find($id); // usando a instância do objeto
        if($modelo == null){
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'],404);
        } 
        if($request->file('imagem')){
            Storage::disk('public')->delete($modelo->imagem);
        }
        $modelo->delete();
        //print_r($modelo->getAttributes()); // os dados antigos
        // getAttributes() é um método do Eloquent que retorna um array com os atributos atuais/alterados do modelo, ou seja, os dados do registro no banco de dados.
        return response()->json(['msg' => 'Modelo deletada com sucesso!'],200);
    }
    
}
