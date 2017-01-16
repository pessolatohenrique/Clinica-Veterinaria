<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*O email de um cliente pode não ser preenchido. Esta alteração permite que o e-mail seja definido como NULL*/
class TornaAtributoEmailDaTabelaClientesComoNull extends Migration {
	public function up()
	{
		Schema::table("clientes",function(Blueprint $table){
		    $table->string('email',255)->nullable()->change();
		});
	}
	public function down()
	{
		Schema::table("clientes",function(Blueprint $table){
		    $table->string('email',255)->nullable();
		});
	}

}
