<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Pessoa;
use App\Models\Ordem_servico;


class OrdemServicoController extends Controller
{
    public function order_register(){
        $list = Pessoa::join('clientes', 'clientes.id_pessoa', '=', 'pessoas.id')
        ->select('pessoas.nome', 'pessoas.cpf', 'clientes.id')->get();
        $fun = Pessoa::join('funcionarios', 'funcionarios.id_pessoa', '=', 'pessoas.id')
        ->select('funcionarios.funcao', 'pessoas.nome', 'funcionarios.id as id_funcionario')->get();
        $ordem = Ordem_Servico::max('id');
        return view('/service_order/register_os', ['list'=> $list, 'fun' => $fun, 'ordem_serv' => $ordem]);
    }

    public function order_list(){
        $list = Pessoa::join('clientes', 'clientes.id_pessoa', '=', 'pessoas.id')
        ->join('ordem_servicos', 'ordem_servicos.id_cliente', '=', 'clientes.id')
        ->join('equipamentos', 'equipamentos.id', '=', 'ordem_servicos.id_equipamento')
        ->select('pessoas.nome', 'ordem_servicos.id', 'ordem_servicos.dt_realizada', 'equipamentos.marca', 'equipamentos.modelo', 'ordem_servicos.status')
        ->get();

        return view('/service_order/list_os', ['list' => $list]);

    }

    public function order_edit(Request $request){
        $dados = Ordem_servico::where('id','=', $request->id_ordem)
            ->update([
                'status' => $request->status,
            ]);
        if($dados){
            return redirect()->route('order_list')->with('edit-status', 'sucess');
        }
    }

    public function order_del($id){
        if(Ordem_servico::where('id', '=', $id)->delete()){
            return redirect()->route('order_list')->with('del-status', 'sucess');
            
        }else{
            return redirect()->route('order_list')->with('del-status', 'fail');
        }
    }

    public function save_order(Request $request){

        $request->validate([
            'num_os' => 'required',
            'tec_name' => 'required',
            'dt_os' => 'required',
            'cos_name' => 'required',
            'equip_name' => 'required',
            'vlr_custo' => 'required',
            'vlr_venda' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            'equip_imei1' => 'IMEI-1 do equipamento',
            'equip_imei2' => 'IMEI-2 do equipamento',
            'equip_marca' => 'Marca do equipamento',
            'equip_num_serie' => 'Número de série do equipamento',
            'equip_cod_bateria' => 'Código da bateria do equipamento',
            'equip_acessorio' => 'Acessórios do equipamento',
            'equip_email' => 'Email do equipamento',
            'equip_modelo' => 'Modelo do equipamento',
            'equip_cor' => 'Cor do equipamento',
            ]);
            $desc = "";
            $desc = implode(" / ", $request->customCheck);
            if($request->prob_adicional != null){
                $desc = $desc.' / Problemas adicionais: '.$request->prob_adicional;
            }
            //CONVERTE STRING MOEDA REAL EM DOUBLE
            $money = explode(" ", $request->vlr_custo);
            $SemVirgula  = str_replace('.', '', $money[1] );
            $SemPonto  = str_replace(',', '.', $SemVirgula );
            $valor_custo = floatval ($SemPonto);
            //
            //CONVERTE STRING MOEDA REAL EM DOUBLE
            $money = explode(" ", $request->vlr_venda);
            $SemVirgula  = str_replace('.', '', $money[1] );
            $SemPonto  = str_replace(',', '.', $SemVirgula );
            $valor_venda = floatval ($SemPonto);
            //

            $ordem = new Ordem_servico();
            $ordem->id_cliente = $request->cos_name;
            $ordem->id_equipamento = $request->equip_name;
            $ordem->id_funcionario = $request->tec_name;
            $ordem->vlr_venda = $valor_venda;
            $ordem->vlr_compra = $valor_custo;
            $ordem->dt_realizada = $request->dt_os;
            $ordem->desc_problema = $desc;
            if($ordem->save()){
                return redirect()->route('order_list')->with('save-status', 'sucess');
            }else{
                return redirect()->route('order_list')->with('save-status', 'fail');
            }
            


    }
}
