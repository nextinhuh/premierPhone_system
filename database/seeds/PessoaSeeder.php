<?php

use Illuminate\Database\Seeder;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('pessoas')->insert([
            'nome' => 'Álvaro Neto',
            'email' => 'alvaro@hotmail.com',
            'telefone' => '996837371',
            'cpf' => '06835346450',
        ]);
    }
}
