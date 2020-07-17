<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Pessoa;
use App\Models\Endereco;
use DateTime;
use Illuminate\Support\Facades\Storage;

class FuncionarioController extends Controller
{

    public function employee_list(){
        
        $list = Pessoa::join('funcionarios', 'funcionarios.id_pessoa', '=', 'pessoas.id')
        ->select('pessoas.*', 'funcionarios.funcao')
        ->get();

        return view('employee/keep_emp', ['list' => $list] );
        //return view('search_so', $this->dados);
    }


    public function employee_register(Request $request){
        
        $request->validate([
            'foto' => 'required',
            'nome_fun' => 'required',
            'cpf' => 'required',
            'telefone' => 'required',
            'email' => 'required',
            'raca' => 'required',
            'dt_admissao' => 'required',
            'funcao' => 'required',
            'nome_pai' => 'required',
            'nome_mae' => 'required',
            'cep' => 'required',
            'rua' => 'required',
            'num_casa' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'rg' => 'required'
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            'foto' => 'Foto do funcionário',
            'nome_fun' => 'Nome do funcionário',
            'cpf' => 'CPF do funcionário',
            'telefone' => 'Contato do funcionário',
            'email' => 'Email do funcionário',
            'raca' => 'Raça do funcionário',
            'dt_admissao' => 'Data de admissão do funcionário',
            'funcao' => 'Função do funcionário',
            'nome_pai' => 'Nome do pai do funcionário',
            'nome_mae' => 'Nome da mãe do funcionário',
            'rg' => 'RG do funcionário',
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
                $pes->nome = $request->nome_fun;
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
                        $request->foto->storeAs('fun', $tes);
                        $fun = new Funcionario();
                        $fun->foto = $tes;
                        $fun->rg = $request->rg;
                        $fun->raca = $request->raca;
                        $fun->funcao = $request->funcao;
                        $fun->nome_pai = $request->nome_pai;
                        $fun->nome_mae = $request->nome_mae;
                        $fun->dt_admissao = $request->dt_admissao;
                        $fun->id_pessoa = $lastId->id;
                        if ($fun->save()) {
                            return redirect()->route('keep_employee')->with('save-status', 'sucess');
                        }else{
                            return back()->with('save-status', 'fail_fun');
                        }
                    }else{
                        return back()->with('save-status', 'fail_end');
                    }
                }
            }else{
                return back()->with('save-status', 'fail_pes');
            }
            
            
        }

        public function employee_edit($id){
            
            $emp = Funcionario::where('id_pessoa', '=', $id)->get();
        
        foreach ($emp as $a) {
            $pes = Pessoa::where('id', '=', $a['id_pessoa'])->get();
            $end = Endereco::where('id_pessoa', '=', $a['id_pessoa'])->get();
        }
        
        $files = Storage::files('fun');
        $path = 0;
        
        foreach ($files as $f) {
            if($f == "fun/". $emp[0]->foto){
                $path = $f;
            }
        }


        return view('employee/edit_emp', ['list' => $emp, 'pes' => $pes, 'end' => $end, 'path' => $path] );
                
    }

    public function save_edit(Request $request){
            
            $request->validate([
               
                'nome_fun' => 'required',
                'cpf' => 'required',
                'telefone' => 'required',
                'email' => 'required',
                'raca' => 'required',
                'dt_admissao' => 'required',
                'funcao' => 'required',
                'nome_pai' => 'required',
                'nome_mae' => 'required',
                'cep' => 'required',
                'rua' => 'required',
                'num_casa' => 'required',
                'complemento' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'uf' => 'required',
                'rg' => 'required'
            ], [
                'required' => 'O campo :attribute é obrigatório!'
            ],[
                
                'nome_fun' => 'Nome do funcionário',
                'cpf' => 'CPF do funcionário',
                'telefone' => 'Contato do funcionário',
                'email' => 'Email do funcionário',
                'raca' => 'Raça do funcionário',
                'dt_admissao' => 'Data de admissão do funcionário',
                'funcao' => 'Função do funcionário',
                'nome_pai' => 'Nome do pai do funcionário',
                'nome_mae' => 'Nome da mãe do funcionário',
                'rg' => 'RG do funcionário',
                'cep' => 'CEP do endereço',
                'rua' => 'Rua do endereço',
                'num_casa' => 'Número da casa do endereço',
                'complemento' => 'Complemento do endereço',
                'bairro' => 'Bairro do endereço',
                'cidade' => 'Cidade do endereço',
                'uf' => 'UF do endereço'
                ]);
                
                $pes = Pessoa::where('id', '=', $request->id)->first();

                if ($pes != null) {
                    $pes->nome = $request->nome_fun;
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
                            $fun = Funcionario::where('id_pessoa', '=', $request->id)->first();
                            if($request->hasFile('foto')){
                                $tes = $request->id.".".$request->foto->extension();
                                $request->foto->storeAs('fun', $tes);
                                $fun->foto = $tes;
                            }
                            $fun->rg = $request->rg;
                            $fun->raca = $request->raca;
                            $fun->funcao = $request->funcao;
                            $fun->nome_pai = $request->nome_pai;
                            $fun->nome_mae = $request->nome_mae;
                            $fun->dt_admissao = $request->dt_admissao;
                            if ($fun->save()) {
                                return redirect()->route('edit_employee', ['id' => $request->id ])->with('save-status', 'sucess');
                            }else{
                                return redirect()->route('edit_employee')->with('save-status', 'fail_fun');
                            }
                        }else{
                            return redirect()->route('edit_employee')->with('save-status', 'fail_end');
                        }
                    }else{
                        return redirect()->route('edit_employee')->with('save-status', 'fail_pes');
                    }
                }
        }
            
        public function employ_Del($id){
            
            if(Funcionario::where('id_pessoa', '=', $id)->delete()){
                if(Endereco::where('id_pessoa', '=', $id)->delete()){
                    if(Pessoa::where('id', '=', $id)->delete()){
                        return redirect()->route('keep_employee')->with('del-status', 'sucess');
                    }else{
                        return redirect()->route('keep_employee')->with('del-status', 'fail');
                    }
                }else{
                    return redirect()->route('keep_employee')->with('del-status', 'fail');
                }
            }else{
                return redirect()->route('keep_employee')->with('del-status', 'fail');
            }

        }

}
