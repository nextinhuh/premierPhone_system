<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordem_servico;
use App\Models\Pessoa;
use PDF;

class PdfController extends Controller
{
    public function order_pdf($id){
        $list = Pessoa::join('clientes', 'clientes.id_pessoa', '=', 'pessoas.id')
        ->join('enderecos', 'enderecos.id_pessoa', '=', 'pessoas.id')
        ->join('ordem_servicos', 'ordem_servicos.id_cliente', '=', 'clientes.id')
        ->join('equipamentos', 'equipamentos.id', '=', 'ordem_servicos.id_equipamento')
        ->select('pessoas.*', 'enderecos.*', 'ordem_servicos.desc_problema', 'equipamentos.*', 'ordem_servicos.dt_realizada', 'clientes.rg', 'ordem_servicos.id as id_ordem')
        ->where('ordem_servicos.id', '=', $id)
        ->get();
        $fun = Pessoa::join('funcionarios', 'funcionarios.id_pessoa', '=', 'pessoas.id')
        ->join('ordem_servicos', 'ordem_servicos.id_funcionario', '=', 'funcionarios.id')
        ->select('pessoas.nome')
        ->where('ordem_servicos.id', '=', $id)
        ->get();
        $tes = explode(" / ",$list[0]['desc_problema']);
        $ultimo = array_pop($tes);
        $num_ordem = $list[0]['id_ordem'];
        $pdf = PDF::loadView('/pdf/order2', compact('list', 'fun', 'tes', 'ultimo', 'num_ordem'));

        return $pdf->setPaper('a4')->stream('service_ordem'.$num_ordem.'.pdf');
    }
}
