<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*cria a tabela de espécies, relacionando com o tipo_animais. Exemplos: poodle, siames, etc.*/
class CriaTabelaEspecies extends Migration {
	public function up()
	{
		Schema::create("especies",function($table){
			$table->increments("id");
			$table->integer("tipoAnimal_id")->unsigned();
			$table->string("nome",30);
			$table->string("descricao");
		});
	}
	public function down()
	{
		Schema::drop("especies");
	}

}
