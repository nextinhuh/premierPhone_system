<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriandoTabelaOrdemServicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('desc_problema');
            $table->string('status')->default('Em Aberto');
            $table->date('dt_realizada');
            $table->float('vlr_compra', 8, 2);
            $table->float('vlr_venda', 8, 2);

            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_equipamento');
            $table->unsignedBigInteger('id_funcionario');
            $table->timestamps();

            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_equipamento')->references('id')->on('equipamentos');
            $table->foreign('id_funcionario')->references('id')->on('funcionarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordem_servicos');
    }
}
