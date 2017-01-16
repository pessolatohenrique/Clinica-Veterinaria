<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*Cria a tabela de Cliente, no qual será relacionado com Animais e Endereco*/
class CriaTabelaCliente extends Migration {
	public function up()
	{
		Schema::create('clientes',function(Blueprint $table){
			$table->increments('id');
			$table->integer('endereco_id')->unsigned();
			$table->char('cpf',11)->unique();
			$table->char('rg',9)->unique(); 
			$table->string('nome',255);
			$table->string('email',255);
			$table->string('telefone',12);
			$table->char('celular',12);
		    $table->foreign('endereco_id')->references('id')->on('enderecos');
		});
	}
	public function down()
	{
		Schema::drop('clientes');
	}

}
