<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Equipamento;

class ClienteController extends Controller
{
    public function listById($id) {
        $tarefas = Pessoa::join('clientes', 'clientes.id_pessoa', '=', 'pessoas.id')
        ->join('enderecos', 'enderecos.id_pessoa', '=', 'pessoas.id')
        ->select('pessoas.*', 'clientes.rg', 'enderecos.*', 'clientes.id as id_cliente')
        ->where('clientes.id', $id)->get();
        return response()->json($tarefas, 200);
    }

    public function listEquipById($id) {
        $tarefas = Equipamento::select('marca', 'modelo', 'cor', 'id')->where('id_cliente', '=', $id)->get();
        return response()->json($tarefas, 200);
    }

    public function equipById($id) {
        $tarefas = Equipamento::where('id', '=', $id)->get();
        return response()->json($tarefas, 200);
    }
}
