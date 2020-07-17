<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Pessoa;

class UsuarioController extends Controller
{

    public function user_keep(){
        $list = Pessoa::join('usuarios', 'usuarios.id_pessoa', '=', 'pessoas.id')
        ->select('pessoas.nome', 'usuarios.privilegio', 'usuarios.id')->get();
        return view('user/keep_user', ['list' => $list]);
    }

    public function user_edit(Request $request){
        $request->validate([
            'tp_usuario' => 'required',
            'nome_usuario' => 'required',
            'login_usuario' => 'required',
            'senha_usuario' => 'same:senha2_usuario|required',
            'senha2_usuario' => 'required'
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            'tp_usuario' => 'Tipo de usuário',
            'nome_usuario' => 'Nome do usuário',
            'login_usuario' => 'Login',
            'senha_usuario' => 'Senha',
            'senha2_usuario' => 'Confirmação de senha'
            ]);

            $dado = Usuario::select('id')->where(['id_pessoa' => $request->nome_usuario, 'login' => $request->login_usuario])->get();
           
            if(isset($dado[0])){
                if(Usuario::where('id','=', $dado[0]['id'])
                ->update([
                    'login' => $request->login_usuario,
                    'senha' => $request->senha_usuario,
                ])){
                return redirect()->route('user_keep')->with('edit-status', 'sucess');
                }
            }else{
                return redirect()->route('user_keep')->with('edit-status', 'fail');
            }
    }

    public function user_del($id){
        if(Usuario::where('id', '=', $id)->delete()){
            return redirect()->route('user_keep')->with('del-status', 'sucess');
        }else{
            return redirect()->route('user_keep')->with('del-status', 'fail');
        }
    }


    public function user_register(Request $request){
        $request->validate([
            'tp_usuario' => 'required',
            'nome_usuario' => 'required',
            'login_usuario' => 'required',
            'senha_usuario' => 'same:senha2_usuario|required',
            'senha2_usuario' => 'required'
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            'tp_usuario' => 'Tipo de usuário',
            'nome_usuario' => 'Nome do usuário',
            'login_usuario' => 'Login',
            'senha_usuario' => 'Senha',
            'senha2_usuario' => 'Confirmação de senha'
            ]);

            if($request->tp_usuario == 'Cliente'){
                $user = new Usuario();
                $user->login = $request->login_usuario;
                $user->senha = $request->senha_usuario;
                $user->privilegio = 0;
                $user->id_pessoa = $request->nome_usuario;
            }else{
                $user = new Usuario();
                $user->login = $request->login_usuario;
                $user->senha = $request->senha_usuario;
                $user->privilegio = 1;
                $user->id_pessoa = $request->nome_usuario;
            }

            if($user->save()){
                return redirect()->route('user_keep')->with('save-status', 'sucess');
            }else{
                return redirect()->route('user_keep')->with('save-status', 'fail');
            }

    }
}
