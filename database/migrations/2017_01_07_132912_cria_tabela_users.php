<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaUsers extends Migration {
	/*Cria a tabela Users, responsável pelo gerenciamento de Login da aplicação*/
	public function up()
	{
		Schema::dropIfExists('login');
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('perfil_id');
			$table->string('name');
			$table->string('email')->unique();
			$table->char('cargo',3);
			$table->string('password', 60);
			$table->rememberToken();
			$table->timestamps();
		});
	}
	public function down()
	{
		Schema::drop('users');
	}

}
