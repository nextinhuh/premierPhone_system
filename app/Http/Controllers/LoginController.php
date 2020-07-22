<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Funcionario;
use App\Models\Pessoa;
use App\Models\Cliente;
use Illuminate\Support\Facades\Storage;
use DateTime;

class LoginController extends Controller
{

    public function tela_principal(){
        return view('front-page/index');
    }

    public function tela_login(){
        return view('front-page/login');
    }

    public function logando(Request $request){
        $request->validate([
            'login' => 'required',
            'senha' => 'required',
            'tp_usuario' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            'login' => 'Login do usuário',
            'senha' => 'Senha do usuário',
            'tp_usuario' => 'Tipo do usuário',
            ]);

        $usuario = Usuario::where(['login' => $request->login, 'senha' => $request->senha])->first();
        
        if ($usuario != null) {

            if($request->tp_usuario == "Funcionário"){
                $fun = Pessoa::join('funcionarios', 'funcionarios.id_pessoa', '=', 'pessoas.id')
                ->select('pessoas.nome', 'funcionarios.foto')
                ->where('funcionarios.id_pessoa', '=', $usuario['id_pessoa'])->get();
                
                if(isset($fun[0])){
                    $files = Storage::files('fun');
                $path = 0;
    
                foreach ($files as $f) {
                if($f == "fun/". $fun[0]->foto){
                $path = $f;
                }
                }
                $saudacao = "";
                $saudacao = LoginController::verificaHora();
                session([
                    'fun_nome' => $fun[0]['nome'],
                    'fun_privilegio'=> $usuario['privilegio'],
                    'fun_foto' => $path,
                    'saudacao' => $saudacao
                    ]);

                return redirect()->route('main');
                }else{
                    return redirect()->route('login')->with('login-status', 'failType');
                }

            }elseif($request->tp_usuario == "Cliente"){
                $cli = Pessoa::join('clientes', 'clientes.id_pessoa', '=', 'pessoas.id')
                ->select('pessoas.nome', 'clientes.foto', 'pessoas.id', 'clientes.id as id_cliente')
                ->where('clientes.id_pessoa', '=', $usuario['id_pessoa'])->get();
                

                if(isset($cli[0])){
                $files = Storage::files('cli');
                $path = 0;
    
                foreach ($files as $f) {
                if($f == "cli/". $cli[0]->foto){
                $path = $f;
                }
                }

                session([
                    'cli_nome' => $cli[0]['nome'],
                    'cli_privilegio'=> $usuario['privilegio'],
                    'cli_foto' => $path,
                    'cli_id_pessoa' => $cli[0]['id'],
                    'cli_id_cliente' =>$cli[0]['id_cliente']
                    ]);
                
                return redirect()->route('client_device');
                }else{
                    return redirect()->route('login')->with('login-status', 'failType');
                }

                

            }else{
            return redirect()->route('login')->with('login-status', 'fail');
            }
        }else{
            return redirect()->route('login')->with('login-status', 'fail');
        }
    }

    public function deslogando(Request $request){
        $request->session()->flush();
        return redirect()->route('index');
    }

    public function verificaHora(){
        $sManha = new DateTime('00:00:00');
        $eManha = new DateTime('11:59:59');

        $sTarde = new DateTime('12:00:00');
        $eTarde = new DateTime('17:59:59');

        $sNoit = new DateTime('18:00:00');
        $eNoite = new DateTime('23:59:59');
        $now = new DateTime('now');

        if($now >= $sManha && $now <=$eManha){
            return  "Bom dia";
        }elseif($now>= $sTarde && $now <=$eTarde){
            return "Boa tarde"; 
        }else{
            return "Boa noite";
        }
                
    }

}
