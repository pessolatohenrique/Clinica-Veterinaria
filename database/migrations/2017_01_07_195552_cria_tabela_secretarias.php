<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaSecretarias extends Migration {
	/*cria a tabela de secretárias*/
	public function up()
	{
		Schema::create('secretarias',function(Blueprint $table){
			$table->increments('id');
			$table->char('cpf',11)->unique();
			$table->string('nome',255);
			$table->string('email',255);
			$table->char('telefone',11);
			$table->char('celular',12);
			$table->date('dataAdmissao');
			$table->time('horaEntrada');
			$table->time('horaSaida');
		});
	}
	public function down()
	{
		Schema::drop('secretarias');
	}

}
