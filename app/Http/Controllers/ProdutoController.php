<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\Fornecedores_produto;
use App\Models\Pessoa;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;


class ProdutoController extends Controller
{
    public function product_register(){
        $for = Fornecedor::join('pessoas', 'pessoas.id', '=', 'fornecedores.id_pessoa')
        ->select('fornecedores.id', 'pessoas.nome')
        ->get();
        
        $cat = Categoria::select()->get();

        return view('product/register_product', ['pes' => $for, 'cat' => $cat]);
    }

    public function product_list(){
        $list = Produto::join('categorias', 'categorias.id', '=', 'produtos.id_categoria')
        ->leftjoin('fornecedores_produtos', 'fornecedores_produtos.id_produto', '=', 'produtos.id')
        ->selectRaw('sum(qtd_prod) as soma, produtos.nome, categorias.nome_categoria, produtos.marca, produtos.vlr_unitario, produtos.id')
        ->groupBy('produtos.nome', 'categorias.nome_categoria', 'produtos.marca', 'produtos.vlr_unitario', 'produtos.id' )
        ->get();
        
        $cat = Categoria::select()->get();
        return view('product/productss', ['list' => $list, 'cat' => $cat]);
    }

    public function save_product(Request $request){

        $request->validate([
            'foto' => 'required',
            'nome_pro' => 'required',
            'marca' => 'required',
            'categoria' => 'required',
            'valor_venda' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório!',
            'different' => 'O campo :attribute tem que ser diferente!'
        ],[
            'foto' => 'Foto do produto',
            'nome_pro' => 'Nome do produto',            
            'marca' => 'Marca do produto',
            'categoria' => 'Categoria do produto',            
            'valor_venda' => 'Valor de venda do produto',
            ]);
            
            $dados = Produto::where('nome', $request->nome_pro)->first();
            //CONVERTE STRING MOEDA REAL EM DOUBLE
            if($request->valor_custo != null){
            $money = explode(" ", $request->valor_custo);
            $SemVirgula  = str_replace('.', '', $money[1] );
            $SemPonto  = str_replace(',', '.', $SemVirgula );
            $valor_compra = floatval ($SemPonto);
            }
            //
            if($request->valor_venda != null){
            $money = explode(" ", $request->valor_venda);
            $SemVirgula  = str_replace('.', '', $money[1] );
            $SemPonto  = str_replace(',', '.', $SemVirgula );
            $valor_venda = floatval ($SemPonto);
            }
            //
            if($dados == null){
                $lastId = Produto::select('id')->orderBy('created_at', 'desc')->first();
                if($lastId == null){
                    $pro = new Produto();
                    $tes = "1.".$request->foto->extension();
                    $request->foto->storeAs('prod', $tes);
                    $pro->img_prod = $tes;-
                    $pro->nome = $request->nome_pro;
                    $pro->marca =$request->marca;                    
                    $pro->vlr_unitario =$valor_venda;                    
                    $pro->id_categoria = $request->categoria;
                }else{
                    $pro = new Produto();
                    $tes = ($lastId->id + 10).".".$request->foto->extension();
                    $request->foto->storeAs('prod', $tes);
                    $pro->img_prod = $tes;
                    $pro->nome = $request->nome_pro;
                    $pro->marca =$request->marca;
                    $pro->vlr_unitario =$valor_venda;
                    $pro->id_categoria = $request->categoria;
                }
                if ($pro->save()) {
                    if($request->fornecedor != null){
                    if($lastId == null){
                        $for_prod = new Fornecedores_produto();
                        $for_prod->id_fornecedor = $request->fornecedor;
                        $for_prod->dt_entrada = $request->dt_entrada;
                        $for_prod->vlr_compra = $valor_compra;
                        $for_prod->total_compra = $valor_compra * $request->quantidade;
                        $for_prod->qtd_prod = $request->quantidade;
                        $for_prod->id_produto = 1;
                    }else{
                        $for_prod = new Fornecedores_produto();
                        $for_prod->id_fornecedor = $request->fornecedor;
                        $for_prod->dt_entrada = $request->dt_entrada;
                        $for_prod->vlr_compra = $valor_compra;
                        $for_prod->total_compra = $valor_compra * $request->quantidade;
                        $for_prod->qtd_prod = $request->quantidade;
                        $for_prod->id_produto =($lastId->id + 10);
                    }
                    
                    if($for_prod->save()){
                        return redirect()->route('product_register')->with('save-status', 'sucess');
                    }else{
                        return redirect()->route('product_register')->with('save-status', 'fail_for');
                    }
                }else{
                    return redirect()->route('product_register')->with('save-status', 'sucess');
                }
                }
            }else{
                return redirect()->route('product_register')->with('save-status', 'exist');
            }
    }

    public function product_edit($id){
        $list = Produto::where('id', '=', $id)->get();
        $cat = Categoria::select()->get();
        $files = Storage::files('prod');
        $path = 0;
        
        foreach ($files as $f) {
            if($f == "prod/". $list[0]->img_prod){
                $path = $f;
            }
        }
        return view('product/edit', ['list' => $list, 'cat' =>$cat, 'path' => $path]);
    }

    public function save_product_edit(Request $request){
        
        $request->validate([
            'nome_prod' => 'required',
            'category' => 'required',
            'marca' => 'required',
            'valor_venda' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            'nome_prod' => 'Nome do produto',
            'marca' => 'Marca do produto',
            'category' => 'Categoria do produto',
            'valor_venda' => 'Valor da venda do produto',
            ]);
            
            $dados = Produto::where('nome', $request->nome)->first();

            $money = explode(" ", $request->valor_venda);
            $SemVirgula  = str_replace('.', '', $money[1] );
            $SemPonto  = str_replace(',', '.', $SemVirgula );
            $valor_venda = floatval ($SemPonto);
            //

            if($dados == null){
                $tes= Produto::select('img_prod')->where('id', '=', $request->id)->first();
                if($request->hasFile('foto')){
                    $tes->img_prod = $request->id.".".$request->foto->extension();
                    $request->foto->storeAs('prod', $tes->img_prod);
                }
                
                if(Produto::where('id', '=', $request->id)->update(
                    ['nome' => $request->nome_prod,
                     'marca' => $request->marca,
                     'vlr_unitario' => $valor_venda,
                     'id_categoria' => $request->category,
                     'img_prod' => $tes->img_prod
                    ])){
                   return redirect()->route('product_edit', ['id' => $request->id])->with('save-status', 'sucess');
                }else{
                   return redirect()->route('product_edit', ['id' => $request->id])->with('save-status', 'fail');
                }
            }else{
                return redirect()->route('product_edit', ['id' => $request->id])->with('save-status', 'exist');

            }
            
    }


}
