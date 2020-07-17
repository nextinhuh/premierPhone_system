<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriandoTabelaEquipamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('imei_1');
            $table->string('imei_2');
            $table->string('marca');
            $table->string('senha_cel')->nullable();
            $table->string('modelo');
            $table->string('cor');
            $table->string('num_serie');
            $table->string('cod_bateria');
            $table->string('acessorios');
            $table->string('email_celular');
            $table->string('historico')->nullable();
            $table->unsignedBigInteger('id_cliente');
            $table->timestamps();

            $table->foreign('id_cliente')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipamentos');
    }
}
