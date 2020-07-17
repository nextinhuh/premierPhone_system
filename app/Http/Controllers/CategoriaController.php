<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use PhpParser\Node\Stmt\Catch_;

class CategoriaController extends Controller
{
    public function category_list(){
        $cat = Categoria::select()->get();

        return view('category/category', ['list' => $cat] );
    }

    public function save_category(Request $request){
        $request->validate([
            'nome' => 'required',
            
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            
            'nome' => 'Nome da categoria'
            ]);
            
            $dados = Categoria::where('nome_categoria', $request->nome)->first();
            
            if($dados == null){
                $cat = new Categoria();
                $cat->nome_categoria = $request->nome;
                if($cat->save()){
                    return redirect()->route('list_category')->with('save-status', 'sucess');
                }else{
                    return redirect()->route('list_category')->with('save-status', 'fail');
                }
            }else{
                return redirect()->route('list_category')->with('save-status', 'exist');
            }
    }

    public function category_edit(Request $request){
        $request->validate([
            'cat_name' => 'required'
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            'cat_name' => 'Nome da categoria'
            ]);
            
            $cat = Categoria::where('id', '=', $request->cat_id)->first();
            
            if($cat != null){
                $cat->nome_categoria = $request->cat_name;
                if($cat->save()){
                    return redirect()->route('list_category')->with('edit-status', 'sucess');
                }else{
                    return redirect()->route('list_category')->with('edit-status', 'fail');
                }
            }else{
                return redirect()->route('list_category')->with('edit-status', 'exist');
            }
    }

    public function category_del($id){
            
        if(Categoria::where('id', '=', $id)->delete()){
            return redirect()->route('list_category')->with('del-status', 'sucess');
        }else{
            return redirect()->route('list_category')->with('del-status', 'fail');
        }
    
    }

}
