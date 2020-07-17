<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pessoa;

class PessoaController extends Controller
{
    public function searcgById($id){

        if($id == "Funcionário"){
            $pes = Pessoa::join('funcionarios', 'funcionarios.id_pessoa', '=', 'pessoas.id')
            ->select('pessoas.nome', 'pessoas.id')->get();
            return response()->json($pes, 200);
        }else{
            $pes = Pessoa::join('clientes', 'clientes.id_pessoa', '=', 'pessoas.id')
            ->select('pessoas.nome', 'pessoas.id')->get();
            return response()->json($pes, 200);
        }


    }
}
