<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PessoaSeeder::class);
        $this->call(EnderecoSeeder::class);
        $this->call(FuncionarioSeeder::class);
        $this->call(UsuarioSeed::class);
    }
}
