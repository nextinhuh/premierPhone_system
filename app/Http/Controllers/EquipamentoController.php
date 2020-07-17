<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamento;


class EquipamentoController extends Controller
{
    public function equipment_list($id){
        $list = Equipamento::select('marca', 'modelo', 'cor', 'id')
        ->where('id_cliente', '=', $id)
        ->get();
        return view('equipment/list', ['list' => $list, 'id_cliente' => $id]);
    }

    public function equipment_edit($id){
        $list = Equipamento::select()->where('id', '=', $id)->get();
        return view('equipment/edit', ['list' => $list]);
    }

    public function equipment_del($id, $id_cli){
        
        if(Equipamento::where('id', '=', $id)->delete()){
            return redirect()->route('equipment_list', ['id' => $id_cli])->with('del-status', 'sucess');
            
        }else{
            return redirect()->route('equipment_list', ['id' => $id_cli])->with('del-status', 'fail');
        }
    
    }

    public function save_equipment(Request $request){
    
        $request->validate([
            'imei1' => 'required',
            'imei2' => 'required',
            'marca' => 'required',
            'cor' => 'required',
            'num_serie' => 'required',
            'cod_bateria' => 'required',
            'acessorio' => 'required',
            'email' => 'required',
            'modelo' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            'imei1' => 'IMEI-1 do equipamento',
            'imei2' => 'IMEI-2 do equipamento',
            'marca' => 'Marca do equipamento',
            'num_serie' => 'Número de série do equipamento',
            'cod_bateria' => 'Código da bateria do equipamento',
            'acessorio' => 'Acessórios do equipamento',
            'email' => 'Email do equipamento',
            'modelo' => 'Modelo do equipamento',
            'cor' => 'Cor do equipamento',
            ]);
            $dados = Equipamento::where('imei_1','=', $request->imei1)->first();
            
            if($dados == null){
                $equip = new Equipamento();
                $equip->imei_1 = $request->imei1;
                $equip->imei_2 = $request->imei2;
                $equip->marca = $request->marca;
                $equip->senha_cel = $request->senha_equip;
                $equip->modelo = $request->modelo;
                $equip->cor = $request->cor;
                $equip->num_serie = $request->num_serie;
                $equip->cod_bateria = $request->cod_bateria;
                $equip->acessorios = $request->acessorio;
                $equip->email_celular = $request->email;
                $equip->id_cliente = $request->id;
                if($equip->save()){
                return redirect()->route('equipment_list', ['id' => $request->id])->with('save-status', 'sucess');
                }else{
                    return redirect()->route('equipment_list', ['id' => $request->id])->with('save-status', 'fail');
                }
            }else{
                return redirect()->route('equipment_list', ['id' => $request->id])->with('save-status', 'exist');
            }
    }


    public function save_edit_equip(Request $request){
        $request->validate([
            'imei1' => 'required',
            'imei2' => 'required',
            'marca' => 'required',
            'cor' => 'required',
            'num_serie' => 'required',
            'cod_bateria' => 'required',
            'acessorio' => 'required',
            'email' => 'required',
            'modelo' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório!'
        ],[
            'imei1' => 'IMEI-1 do equipamento',
            'imei2' => 'IMEI-2 do equipamento',
            'marca' => 'Marca do equipamento',
            'num_serie' => 'Número de série do equipamento',
            'cod_bateria' => 'Código da bateria do equipamento',
            'acessorio' => 'Acessórios do equipamento',
            'email' => 'Email do equipamento',
            'modelo' => 'Modelo do equipamento',
            'cor' => 'Cor do equipamento',
            ]);
            $dados = Equipamento::where('id','=', $request->id)
            ->update([
                'imei_1' => $request->imei1,
                'imei_2' => $request->imei2,
                'marca' => $request->marca,
                'senha_cel' => $request->senha_equip,
                'modelo' => $request->modelo,
                'cor' => $request->cor,
                'num_serie' => $request->num_serie,
                'cod_bateria' => $request->cod_bateria,
                'acessorios' => $request->acessorio,
                'email_celular' => $request->email
            ]);

            if($dados){
                return redirect()->route('equipment_list', ['id' => $request->id_cliente])->with('edit-status', 'sucess');
            }else{
                return redirect()->route('equipment_list', ['id' => $request->id_cliente])->with('edit-status', 'fail');
            }

    }



}
