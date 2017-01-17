<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*A altura de um animal é dada em centímetros. Esta migration realiza a alteração da precisão de dados*/
class AlteraCampoAlturaDaTabelaAnimais extends Migration {
	public function up()
	{
		Schema::table('animais',function(Blueprint $table){
			$table->decimal('altura',5,2)->change(); 
		});
	}
	public function down()
	{
		$table->decimal('altura',3,2)->change();
	}

}
