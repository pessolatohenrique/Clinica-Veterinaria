<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*adiciona a chave estrangeira de tipoAnimal_id na tabela de especies*/
class AdicionaForeignKeyNaTabelaEspecies extends Migration {
	public function up()
	{
		Schema::table("especies",function(Blueprint $table){
			$table->foreign('tipoAnimal_id')->references('id')->on('tipo_animais')->unsigned();
		});
	}
	public function down()
	{
		$table->integer('tipo_animal_id')->unsigned()->nullable();
	}
}
