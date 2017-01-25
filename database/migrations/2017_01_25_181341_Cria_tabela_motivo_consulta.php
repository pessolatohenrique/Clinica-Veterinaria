<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*Cria a tabela com motivos de uma consulta. Exemplos: enfermidade, retorno, rotina */
class CriaTabelaMotivoConsulta extends Migration {
	public function up()
	{
		Schema::create('motivos_consulta',function(Blueprint $table){
			$table->increments("id");	
			$table->string("motivo",40);
		});
	}
	public function down()
	{
		Schema::drop('motivos_consulta');
	}

}
