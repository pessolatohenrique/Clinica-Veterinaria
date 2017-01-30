<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*Cria a tabela consultas_veterinario, no qual irá armazenar as consultas realizadas por todos os veterinários, permitindo filtrar por veterinários futuramente*/
class CriaTabelaConsultasVeterinario extends Migration {
	public function up()
	{
		// Criar tabela **consultas_veterinario**, com os campos: veterinario_id, animal_id, data, sintomas, diagnóstico, tratamento, tratamento_encerrado (boolean)
		Schema::create("consultas_veterinario",function(Blueprint $table){
			$table->increments("id");
			$table->integer("veterinario_id");
			$table->integer("animal_id")->unsigned();
			$table->date("data");
			$table->text("sintomas");
			$table->text("diagnostico");
			$table->text("tratamento");
			$table->boolean("tratamento_encerrado");
		    $table->foreign('veterinario_id')->references('id')->on('veterinarios');
		    $table->foreign("animal_id")->references("id")->on("animais");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("consultas_veterinario");
	}

}
