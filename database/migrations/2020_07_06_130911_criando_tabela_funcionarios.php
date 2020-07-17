<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriandoTabelaFuncionarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('foto')->nullable();
            $table->string('rg');
            $table->string('raca');
            $table->date('dt_admissao');
            $table->date('dt_demissao')->default('3000-12-31');
            $table->string('funcao');
            $table->string('nome_pai');
            $table->string('nome_mae');
            $table->unsignedBigInteger('id_pessoa');
            $table->timestamps();

            $table->foreign('id_pessoa')->references('id')->on('pessoas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}
