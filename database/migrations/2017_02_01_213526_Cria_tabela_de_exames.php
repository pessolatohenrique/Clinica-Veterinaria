<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*Cria a tabela de exames marcados, relacionado a uma consulta realizada pelo veterinário*/
class CriaTabelaDeExames extends Migration {
	/*Criar tabela com os campos: consulta_id, nome do exame, objetivo, analisado (boolean)*/
	public function up()
	{
		Schema::create("exames",function(Blueprint $table){
			$table->increments("id");
			$table->integer("consulta_id")->unsigned();
			$table->string("nome",255);
			$table->text("objetivo");
			$table->boolean("analisado");
			$table->foreign('consulta_id')->references('id')->on('consultas_veterinario');
		});
	}
	public function down()
	{
		Schema::drop("exames");
	}

}
