<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*Cria a migration de animais, relacionando com clientes e espécie*/
class CriaTabelaAnimais extends Migration {
	/*Criar migration de **Animal**, relacionando com cliente (cliente_id) e espécie (especie_id). Campos, além de relacionados: nome, altura e peso*/
	public function up()
	{
		Schema::create('animais',function(Blueprint $table){
			$table->increments('id');
			$table->integer('cliente_id')->unsigned();
			$table->integer('especie_id')->unsigned();
			$table->string('nome',55);
			$table->decimal('peso',5,2);
			$table->decimal('altura',3,2);
			$table->foreign('cliente_id')->references('id')->on('clientes');
			$table->foreign('especie_id')->references('id')->on('especies');
		});
	}
	public function down()
	{
		Schema::drop('animais');
	}

}
