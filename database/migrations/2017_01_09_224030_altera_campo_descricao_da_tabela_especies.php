<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlteraCampoDescricaoDaTabelaEspecies extends Migration {
	/*O campo descrição está como varchar(255). Com essa Migration, ele passará a ser um tipo TEXT*/
	public function up()
	{
		Schema::table("especies",function(Blueprint $table){
			$table->text('descricao')->change();
		});
	}
	public function down()
	{
		Schema::table("especies",function(Blueprint $table){
			$table->string("descricao",255)->change();
		});
	}

}
