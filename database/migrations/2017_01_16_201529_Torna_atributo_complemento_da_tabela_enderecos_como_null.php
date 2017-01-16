<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*O atributo complemento, da tabela endereços poderá ser NULL. Essa alteração permitirá que o campo seja NULL*/
class TornaAtributoComplementoDaTabelaEnderecosComoNull extends Migration {
	public function up()
	{
		Schema::table("enderecos",function(Blueprint $table){
		    $table->string('complemento',10)->nullable()->change();
		});
	}
	public function down()
	{
		Schema::table("enderecos",function(Blueprint $table){
			$table->string("complemento",10);
		});
	}

}
