<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $credenciais = $request->all(['email', 'password']);
        //autenticação(email e senha)

        $token = auth('api')->attempt($credenciais);

        if($token){ //caso o usuário seja autenticado com sucesso
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['erro' => 'Usuário ou senha inválido!'], 403);

            //401 = Unauthorized -> não autorizado
            //403 = forbidden -> proibido(login invertido)
        }
        
        //retornar um token(JWT)
        return 'login';
    }
    public function logout(){
        auth('api')->logout();
        return response()->json(['msg' => 'Logout foi realizado com sucesso!']);
    }
    public function refresh(){
        $token = auth('api')->refresh(); //cliente encaminhe um jwt válido
        return response()->json(['token' => $token]);
    }
    public function me(){
        return response()->json(auth()->user());
    }
}

// iat : inicio
// exp: final