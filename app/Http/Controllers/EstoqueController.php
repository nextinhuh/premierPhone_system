<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\Fornecedores_produto;
use App\Models\Pessoa;
use App\Models\Categoria;

class EstoqueController extends Controller
{
    public function inventory_list(){
        $list = Pessoa::join('fornecedores', 'fornecedores.id_pessoa', '=', 'pessoas.id')
        ->join('fornecedores_produtos', 'fornecedores_produtos.id_fornecedor', '=', 'fornecedores.id')
        ->join('produtos', 'produtos.id', '=', 'fornecedores_produtos.id_produto')
        ->select('pessoas.nome','produtos.nome as nome_prod', 'produtos.id', 'fornecedores_produtos.dt_entrada',
         'qtd_prod', 'produtos.vlr_unitario', 'fornecedores_produtos.vlr_compra','fornecedores_produtos.total_compra')
        ->get();
        
        return view('inventory/inventory', ['list' => $list]);
    }

    public function inventory_register(){
        $for = Fornecedor::join('pessoas', 'pessoas.id', '=', 'fornecedores.id_pessoa')
        ->select('fornecedores.id', 'pessoas.nome')
        ->get();

        $prod = Produto::select('nome', 'id')->get();


        return view('inventory/register', ['pes' => $for, 'prod' => $prod]);
    }

    public function save_inventory(Request $request){
        
        $request->validate([
            'id_prod' => 'required',
            'fornecedor' => 'required',
            'valor_custo' => 'required',
            'quantidade' => 'required',
            'dt_entrada' => 'required'
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            'id_prod' => 'Nome do produto',
            'fornecedor' => 'Fornecedor do produto',
            'valor_custo' => 'Valor de custo do produto',
            'quantidade' => 'Quantidade do produto',
            'dt_entrada' => 'Data de entrada do produto'
            ]);
            
            $dados = Produto::where('id', $request->id_prod)->first();
            //CONVERTE STRING MOEDA REAL EM DOUBLE
            $money = explode(" ", $request->valor_custo);
            $SemVirgula  = str_replace('.', '', $money[1] );
            $SemPonto  = str_replace(',', '.', $SemVirgula );
            $valor_compra = floatval ($SemPonto);
            //
            if($dados != null){
                $for_prod = new Fornecedores_produto();
                $for_prod->id_fornecedor = $request->fornecedor;
                $for_prod->dt_entrada = $request->dt_entrada;
                $for_prod->vlr_compra = $valor_compra;
                $for_prod->total_compra = $valor_compra * $request->quantidade;
                $for_prod->qtd_prod = $request->quantidade;
                $for_prod->id_produto = $request->id_prod;
                if($for_prod->save()){
                return redirect()->route('inventory_register')->with('save-status', 'sucess');
                }else{
                    return redirect()->route('inventory_register')->with('save-status', 'fail');
                }
            }else{
                return redirect()->route('inventory_register')->with('save-status', 'exist');
            }
    }


}
