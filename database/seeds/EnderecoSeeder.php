<?php

use Illuminate\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('enderecos')->insert([
            'cep' => '57082000',
            'logradouro' => 'Belmiro Amorim',
            'num_casa' => '38A',
            'complemento' => '',
            'bairro' => 'Santa Lúcia',
            'cidade' => 'Maceió',
            'uf' => 'AL',
            'id_pessoa' => '1',
        ]);

         
    }
}
