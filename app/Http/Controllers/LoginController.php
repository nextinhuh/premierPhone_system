<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Funcionario;
use App\Models\Pessoa;
use App\Models\Cliente;
use Illuminate\Support\Facades\Storage;


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
                $files = Storage::files('fun');
                $path = 0;
    
                foreach ($files as $f) {
                if($f == "fun/". $fun[0]->foto){
                $path = $f;
                }
                }
                session([
                    'fun_nome' => $fun[0]['nome'],
                    'fun_privilegio'=> $usuario['privilegio'],
                    'fun_foto' => $path
                    ]);

                    return redirect()->route('main');
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

}
