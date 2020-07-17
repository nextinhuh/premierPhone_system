<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\Fornecedores_produto;
use App\Models\Pessoa;
use App\Models\Produtos_venda;

class VendaController extends Controller
{
    public function sale_register(){
        $list = Produto::leftjoin('fornecedores_produtos', 'fornecedores_produtos.id_produto', '=', 'produtos.id')
        ->selectRaw('sum(qtd_prod) as soma, produtos.nome, produtos.vlr_unitario, produtos.id, produtos.img_prod')
        ->groupBy('produtos.nome', 'produtos.vlr_unitario', 'produtos.id', 'produtos.img_prod' )
        ->get();

        $list_fun = Pessoa::join('funcionarios', 'funcionarios.id_pessoa', '=', 'pessoas.id')
        ->select('funcionarios.id as id_fun', 'pessoas.nome', 'funcionarios.funcao')
        ->get();

        $list_cli = Pessoa::join('clientes', 'clientes.id_pessoa', '=', 'pessoas.id')
        ->select('clientes.id as id_cli', 'pessoas.nome', 'pessoas.cpf')
        ->get();
        
        return view('sale/register_sale', ['list' => $list, 'list_fun' => $list_fun, 'list_cli' => $list_cli]);
    }

    public function sale_list(){
        $list = Pessoa::join('clientes', 'clientes.id_pessoa', '=', 'pessoas.id')
        ->join('vendas', 'vendas.id_cliente', '=', 'clientes.id')
        ->select('vendas.dt_venda', 'pessoas.nome', 'vendas.valor_venda', 'vendas.id')
        ->get();
        
        return view ('sale/list_sale', ['list' => $list]);
    }

    public function save_sale(Request $request){
        $status = false;
        $res2 = 0;
        $request->validate([
            'nome_cli' => 'required',
            'nome_fun' => 'required',
            'dt_venda' => 'required',
            'vlr_total' => 'required',
            'nome_prod0' => 'required',
            'vlr_uni0' => 'required',
            'qtd_prod0' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            'nome_cli' => 'Nome do cliente',
            'nome_fun' => 'Nome do funcionário',
            'dt_venda' => 'Data da venda',
            'nome_prod0' => 'Nome do produto',
            'vlr_uni0' => 'Valor unitário',
            'qtd_prod0' => 'Quantidade',
            ]);


        $ven = new Venda();
        $ven->id_cliente = $request->id_cli;
        $ven->id_funcionario = $request->id_fun;
        $ven->dt_venda = $request->dt_venda;
        $ven->valor_venda = $request->vlr_total;
        

        if($ven->save()){
        $lastId = Venda::select('id')->orderBy('created_at', 'desc')->first();

        $tes = 0;
        
        $n = 'nome_prod'.$tes;
        $n2 = 'vlr_uni'.$tes;
        $n3 = 'qtd_prod'.$tes;        

        while ($request->$n != null) {

            $ultimoFornecedor = Fornecedores_produto::where('id_produto', '=', $request->$n)
            ->where('qtd_prod', '>', 0)->orderBy('dt_entrada', 'asc')->get();

            $res = $ultimoFornecedor[0]['qtd_prod'] - $request->$n3;

            if($res < 0){

            $qt = $request->$n3;
            foreach($ultimoFornecedor as $u){
            $res2 = 0;
            $res = $u['qtd_prod'] - $qt;
            if($res < 0){
                $res2 = $res + abs($res);
                $qt = abs($res);
            }else{
                $res2 = $res;
                $qt = 0;
            }            
            
            if(Fornecedores_produto::where('id','=', $u['id'])
            ->update([
                'qtd_prod' => $res2
            ])){
                if($qt == 0){
                $prod_venda = new Produtos_venda();
                $prod_venda->id_venda = $lastId->id;
                $prod_venda->id_produto = $request->$n;
                $prod_venda->qtd_prod = $request->$n3;
                $prod_venda->vlr_unitario = $request->$n2;
                if($prod_venda->save()){
                    $status = true;
                    break;
                }
                }
            }

            }

            }else{
                if(Fornecedores_produto::where('id','=', $ultimoFornecedor[0]['id'])
            ->update([
                'qtd_prod' => $res
            ])){
                $prod_venda = new Produtos_venda();
                $prod_venda->id_venda = $lastId->id;
                $prod_venda->id_produto = $request->$n;
                $prod_venda->qtd_prod = $request->$n3;
                $prod_venda->vlr_unitario = $request->$n2;
                if($prod_venda->save()){
                    $status = true;
                }
            }
            }
            $tes++; 
            $n = 'nome_prod'.$tes;
            $n2 = 'vlr_uni'.$tes;
            $n3 = 'qtd_prod'.$tes;
        }

        if($status){
            return redirect()->route('sale_register')->with('save-status', 'sucess');
        }else{
            return redirect()->route('sale_register')->with('save-status', 'fail');
        }

        }else{
            return redirect()->route('sale_register')->with('save-status', 'fail');
        }
    }


}
