<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*Tabela que representa os pagamentos a serem realizados para as consultas médicas*/
class CriaTabelaDePagamentos extends Migration {
	public function up()
	{
		Schema::create('pagamentos',function(Blueprint $table){
			$table->increments('id');
			$table->integer("consulta_id")->unsigned();
			$table->decimal("valor",6,2); 
			$table->boolean("status");
		  	$table->foreign('consulta_id')->references('id')->on('consultas_veterinario');
		});
	}
	public function down()
	{
		Schema::drop('pagamentos');
	}
}