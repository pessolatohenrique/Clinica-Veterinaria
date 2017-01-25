<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*Cria tabela que permitirá a secretária registrar/marcar uma nova consulta*/
class CriaTabelaDeMarcarConsulta extends Migration {
	public function up()
	{
		/*Criar tabela com os campos: id, animal_id (relacionado), veterinario_id (relacionado), data, horário, motivo, descrição do motivo*/
		Schema::create("consultas_medicas",function(Blueprint $table){
			$table->increments("id");
			$table->integer("animal_id")->unsigned();
			$table->integer("veterinario_id");
			$table->integer("motivo_id")->unsigned();
			$table->date("data");
			$table->time("horario");
			$table->text("observacao");
			$table->foreign('animal_id')->references('id')->on('animais');
			$table->foreign('veterinario_id')->references('id')->on('veterinarios');
			$table->foreign('motivo_id')->references('id')->on('motivos_consulta');
		});
	}
	public function down()
	{
		Schema::drop("consultas_medicas");
	}

}
