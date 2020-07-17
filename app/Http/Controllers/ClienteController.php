<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Endereco;
use App\Models\Cliente;
use Illuminate\Support\Facades\Storage;


class ClienteController extends Controller
{
    public function costumer_register(){
        return view('costumer/register_cos');
    }

    public function costumer_list(){

        $list = Pessoa::join('clientes', 'clientes.id_pessoa', '=', 'pessoas.id')
        ->select('pessoas.*', 'clientes.id as cliente_id')
        ->get();
        
        return view('costumer/consult_cos', ['list' => $list] );
        //return view('search_so', $this->dados);
    }

    public function costumer_edit($id){
            
        $emp = Cliente::where('id_pessoa', '=', $id)->get();
    
    foreach ($emp as $a) {
        $pes = Pessoa::where('id', '=', $a['id_pessoa'])->get();
        $end = Endereco::where('id_pessoa', '=', $a['id_pessoa'])->get();
    }
    
    $files = Storage::files('cli');
    $path = 0;
    
    foreach ($files as $f) {
        if($f == "cli/". $emp[0]->foto){
            $path = $f;
        }
    }


    return view('costumer/edit_cos', ['list' => $emp, 'pes' => $pes, 'end' => $end, 'path' => $path] );
       
}

public function costumer_del($id){
            
    if(Cliente::where('id_pessoa', '=', $id)->delete()){
        if(Endereco::where('id_pessoa', '=', $id)->delete()){
            if(Pessoa::where('id', '=', $id)->delete()){
                return redirect()->route('list_costumer')->with('del-status', 'sucess');
            }else{
                return redirect()->route('list_costumer')->with('del-status', 'fail');
            }
        }else{
            return redirect()->route('list_costumer')->with('del-status', 'fail');
        }
    }else{
        return redirect()->route('list_costumer')->with('del-status', 'fail');
    }

}

    public function save_register(Request $request){
        $request->validate([
            'foto' => 'required',
            'nome_cli' => 'required',
            'cpf' => 'required',
            'telefone' => 'required',
            'email' => 'required',
            'rg' => 'required',
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
            'foto' => 'Foto do cliente',
            'nome_cli' => 'Nome do cliente',
            'cpf' => 'CPF do cliente',
            'telefone' => 'Contato do cliente',
            'email' => 'Email do cliente',
            'rg' => 'RG do cliente',
            'cep' => 'CEP do endereço',
            'rua' => 'Rua do endereço',
            'num_casa' => 'Número da casa do endereço',
            'complemento' => 'Complemento do endereço',
            'bairro' => 'Bairro do endereço',
            'cidade' => 'Cidade do endereço',
            'uf' => 'UF do endereço'
            ]);
            
            $dados = Pessoa::where('cpf', $request->cpf)->first();
            
            if($dados == null){
                $pes = new Pessoa();
                $pes->nome = $request->nome_cli;
                $pes->email =$request->email;
                $pes->telefone = $request->telefone;
                $pes->cpf = $request->cpf;
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
                        $tes = $lastId->id.".".$request->foto->extension();
                        $request->foto->storeAs('cli', $tes);
                        $cli = new Cliente();
                        $cli->foto = $tes;
                        $cli->rg = $request->rg;
                        $cli->id_pessoa = $lastId->id;
                        if ($cli->save()) {
                            return redirect()->route('register_cos')->with('save-status', 'sucess');
                        }else{
                            return redirect()->route('register_cos')->with('save-status', 'fail_fun');
                        }
                    }else{
                        return redirect()->route('register_cos')->with('save-status', 'fail_end');
                    }
                }
            }else{
                return redirect()->route('register_cos')->with('save-status', 'fail_pes');
            }
    }

    public function save_edit(Request $request){
        $request->validate([
            
            'nome_cli' => 'required',
            'cpf' => 'required',
            'telefone' => 'required',
            'email' => 'required',
            'rg' => 'required',
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
            
            'nome_cli' => 'Nome do cliente',
            'cpf' => 'CPF do cliente',
            'telefone' => 'Contato do cliente',
            'email' => 'Email do cliente',
            'rg' => 'RG do cliente',
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
                $pes->nome = $request->nome_cli;
                $pes->email =$request->email;
                $pes->telefone = $request->telefone;
                $pes->cpf = $request->cpf;
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
                        $cli = Cliente::where('id_pessoa', '=', $request->id)->first();
                        if($request->hasFile('foto')){
                            $tes = $request->id.".".$request->foto->extension();
                            $request->foto->storeAs('cli', $tes);
                            $cli->foto = $tes;
                        }
                        $cli->rg = $request->rg;
                        if ($cli->save()) {
                            return redirect()->route('list_costumer')->with('save-status', 'sucess');
                        }else{
                            return redirect()->route('list_costumer')->with('save-status', 'fail_fun');
                        }
                    }else{
                        return redirect()->route('list_costumer')->with('save-status', 'fail_end');
                    }
                }
            }else{
                return redirect()->route('list_costumer')->with('save-status', 'fail_pes');
            }
    }

}
