<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Fornecedores_produto;

class FornecedorController extends Controller
{
    public function supplier_list(){


        $list = Pessoa::join('fornecedores', 'fornecedores.id_pessoa', '=', 'pessoas.id')
        ->select('pessoas.*')
        ->get();

        return view('supplier/supplier', ['list' => $list] );
    }

    public function supplier_register(){
        return view('supplier/register_supplier');
    }


    public function supplier_edit($id){
            
        $emp = Fornecedor::where('id_pessoa', '=', $id)->get();
    
    foreach ($emp as $a) {
        $pes = Pessoa::where('id', '=', $a['id_pessoa'])->get();
        $end = Endereco::where('id_pessoa', '=', $a['id_pessoa'])->get();
    }
    


    return view('supplier/edit_sup', ['list' => $emp, 'pes' => $pes, 'end' => $end] );
       
}

public function supplier_del($id){
            
    $dado = Fornecedores_produto::where('id_fornecedor', '=', $id);
    
    if($dado == null){

    if(Fornecedor::where('id_pessoa', '=', $id)->delete()){
        if(Endereco::where('id_pessoa', '=', $id)->delete()){
            if(Pessoa::where('id', '=', $id)->delete()){
                return redirect()->route('supplier_list')->with('del-status', 'sucess');
            }else{
                return redirect()->route('supplier_list')->with('del-status', 'fail');
            }
        }else{
            return redirect()->route('supplier_list')->with('del-status', 'fail');
        }
    }else{
        return redirect()->route('supplier_list')->with('del-status', 'fail');
    }

}else{
    return redirect()->route('supplier_list')->with('del-status', 'exist');
}

}


    public function save_supplier(Request $request){
        $request->validate([
            'nome_for' => 'required',
            'cnpj' => 'required',
            'telefone' => 'required',
            'email' => 'required',
            'cep' => 'required',
            'rua' => 'required',
            'num_casa' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required'
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            'nome_for' => 'Nome do fornecedor',
            'cnpj' => 'CNPJ do fornecedor',
            'telefone' => 'Contato do fornecedor',
            'email' => 'Email do fornecedor',
            'cep' => 'CEP do endereço',
            'rua' => 'Rua do endereço',
            'num_casa' => 'Número da casa do endereço',
            'complemento' => 'Complemento do endereço',
            'bairro' => 'Bairro do endereço',
            'cidade' => 'Cidade do endereço',
            'uf' => 'UF do endereço'
            ]);
            
            $dados = Pessoa::where('cnpj', $request->cnpj)->first();

            if($dados == null){
                $pes = new Pessoa();
                $pes->nome = $request->nome_for;
                $pes->email =$request->email;
                $pes->telefone = $request->telefone;
                $pes->cnpj = $request->cnpj;
                if ($pes->save()) {
                    $end = new Endereco();
                    $end->cep = $request->cep;
                    $end->logradouro =$request->rua;
                    $end->num_casa = $request->num_casa;
                    $end->complemento = $request->complemento;
                    $end->bairro = $request->bairro;
                    $end->cidade = $request->cidade;
                    $end->uf = $request->uf;
                    $lastId = Pessoa::select('id')->orderBy('created_at', 'desc')->first();
                    $end->id_pessoa = $lastId->id;
                    if ($end->save()) {
                        $for = new Fornecedor();
                        $for->id_pessoa = $lastId->id;
                        if ($for->save()) {
                            return redirect()->route('supplier_register')->with('save-status', 'sucess');
                        }else{
                            return redirect()->route('supplier_register')->with('save-status', 'fail_fun');
                        }
                    }else{
                        return redirect()->route('supplier_register')->with('save-status', 'fail_end');
                    }
                }
            }else{
                return redirect()->route('supplier_register')->with('save-status', 'fail_pes');
            }
    }

    public function save_edit_sup(Request $request){
        
            $request->validate([
                'nome_for' => 'required',
                'cnpj' => 'required',
                'telefone' => 'required',
                'email' => 'required',
                'cep' => 'required',
                'rua' => 'required',
                'num_casa' => 'required',
                'complemento' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'uf' => 'required'
            ], [
                'required' => 'O campo :attribute é obrigatório!'
            ],[
                'nome_for' => 'Nome do fornecedor',
                'cnpj' => 'CNPJ do fornecedor',
                'telefone' => 'Contato do fornecedor',
                'email' => 'Email do fornecedor',
                'cep' => 'CEP do endereço',
                'rua' => 'Rua do endereço',
                'num_casa' => 'Número da casa do endereço',
                'complemento' => 'Complemento do endereço',
                'bairro' => 'Bairro do endereço',
                'cidade' => 'Cidade do endereço',
                'uf' => 'UF do endereço'
                ]);
            
            $pes = Pessoa::where('id', '=', $request->id)->first();
            
            if($pes != null){
                $pes->nome = $request->nome_for;
                $pes->email =$request->email;
                $pes->telefone = $request->telefone;
                $pes->cnpj = $request->cnpj;
                if ($pes->save()) {
                    $end = Endereco::where('id_pessoa', '=', $request->id)->first();
                    $end->cep = $request->cep;
                    $end->logradouro =$request->rua;
                    $end->num_casa = $request->num_casa;
                    $end->complemento = $request->complemento;
                    $end->bairro = $request->bairro;
                    $end->cidade = $request->cidade;
                    $end->uf = $request->uf;
                        if ($end->save()) {
                            return redirect()->route('supplier_list')->with('save-status', 'sucess');
                        }else{
                            return redirect()->route('supplier_list')->with('save-status', 'fail_fun');
                        }
                }else{
                    return redirect()->route('supplier_list')->with('save-status', 'fail_end');
                }
            }else{
                return redirect()->route('supplier_list')->with('save-status', 'fail_pes');
            }
    }


}
