<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriandoTabelaFornecedoresProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores_produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_fornecedor');
            $table->unsignedBigInteger('id_produto');
            $table->date('dt_entrada');
            $table->integer('qtd_prod');
            $table->float('vlr_compra', 8, 2);
            $table->float('total_compra', 8, 2);
            $table->timestamps();

            $table->foreign('id_fornecedor')->references('id')->on('fornecedores');
            $table->foreign('id_produto')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedores_produtos');
    }
}
