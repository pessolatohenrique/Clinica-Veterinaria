<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*Cria a tabela de endereços, com o objetivo de guardar endereços do sistema e relacioná-los aos clientes*/
class CriaTabelaEnderecos extends Migration {
	public function up()
	{
		Schema::create("enderecos",function(Blueprint $table){
			$table->increments('id');
			$table->char('cep',8);
			$table->string('logradouro',255);
			$table->string('numero',4);
			$table->string('complemento',10);
			$table->string('bairro',255);
			$table->string('cidade',255);
			$table->char('estado',2);
		});
	}
	public function down()
	{
		Schema::drop("enderecos");
	}

}
