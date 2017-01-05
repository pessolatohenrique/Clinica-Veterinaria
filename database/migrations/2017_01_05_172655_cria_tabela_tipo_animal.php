<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*Migration que cria a tabela tipo animal. Exemplos de tipos de animais: cachorro, gato, peixe, etc.*/
class CriaTabelaTipoAnimal extends Migration {
	public function up()
	{
		Schema::create("tipo_animais",function($table){
			$table->increments("id");
			$table->string("descricao",20);
		});
	}
	public function down()
	{
		Schema::drop("tipo_animais");
	}

}
