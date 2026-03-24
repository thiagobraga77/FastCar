<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

     protected $fillable = ['marca_id', 'nome', 'imagem', 'numero_portas', 'lugares', 'air_bag', 'abs'];

    public function rules() {
        return [
            'marca_id' => 'exists:marcas,id',
            'nome' => 'required|unique:modelos,nome,'.$this->id.'|min:3',
            'imagem' => 'required|file|mimes:png,jpeg,jpg',
            'numero_portas' => 'required|integer|digits_between:1,5',
            'lugares' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean', // true, false, 1, 0, "1"
        ];
        /*
        1) tabela
        2) nome da coluna que será pesquisada na tabela
        3) id do registro que será desconseriderado na pesquisa
        */
    }

     public function feedback() {
        return [
            'marca_id.exists' => 'A marca informada não existe.',

            'nome.required' => 'O nome do modelo é obrigatório.',
            'nome.unique' => 'Este nome de modelo já está cadastrado.',
            'nome.min' => 'O nome do modelo deve ter no mínimo 3 caracteres.',

            'imagem.required' => 'A imagem é obrigatória.',
            'imagem.file' => 'O arquivo enviado deve ser uma imagem válida.',
            'imagem.mimes' => 'A imagem deve ser do tipo PNG, JPEG ou JPG.',

            'numero_portas.required' => 'O número de portas é obrigatório.',
            'numero_portas.integer' => 'O número de portas deve ser um valor inteiro.',
            'numero_portas.digits_between' => 'O número de portas deve ter entre 1 e 5 dígitos.',

            'lugares.required' => 'A quantidade de lugares é obrigatória.',
            'lugares.integer' => 'A quantidade de lugares deve ser um valor inteiro.',
            'lugares.digits_between' => 'A quantidade de lugares deve ter entre 1 e 20 dígitos.',

            'air_bag.required' => 'O campo air bag é obrigatório.',
            'air_bag.boolean' => 'O campo air bag deve ser verdadeiro ou falso.',

            'abs.required' => 'O campo ABS é obrigatório.',
            'abs.boolean' => 'O campo ABS deve ser verdadeiro ou falso.',
        ];
    }
    public function marca() {
        // Um modelo pertence a uma marca
        return $this->belongsTo('App\Models\Marca');
    }
}
