<?php

use Illuminate\Database\Seeder;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funcionarios')->insert([
            'id_pessoa' => '1',
            'rg' => '34.099.533-6',
            'raca' => 'Branco',
            'dt_admissao' => '2020-07-03',
            'funcao' => 'Developer',
            'nome_pai' => 'Alberto Nathanael',
            'nome_mae' => 'Marinalva Clarice',
        ]);
    }
}
