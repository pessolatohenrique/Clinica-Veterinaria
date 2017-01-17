<?php 
if(Auth::guest()):
	$usuario = "Não Logado";
else:
	$usuario = Auth::user()->cargo;
endif;
?>
<!DOCTYPE html>
<html>
<head>
	<title>@yield("titulo")</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" type="text/css" href="/css/custom.css">
	<link rel="stylesheet" type="text/css" href="/css/custom-theme/jquery-ui-1.9.2.custom.min.css">
	<script type="text/javascript" src="/js/jquery-1.12.1.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/jquery.mask.js"></script>
	<script type="text/javascript" src="/js/geral.js"></script>
	<script src="https://use.fontawesome.com/b17cc3a995.js"></script>
	<script type="text/javascript" src="/js/jquery-ui-1.10.4.custom.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
	    	<div class="navbar-header">
		    	<a class="navbar-brand" href="#">Clínica Veterinária</a>
		    </div>
		    <ul class="nav navbar-nav">
  				<li class="active"><a href="{{action('LoginController@index')}}">Home</a></li>
  				@if($usuario == 'SEC')
  				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Adicionar Novo
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
 						<li><a href="#">Animal</a></li>
  						<li><a href="#">Cliente</a></li>
  						<li><a href="/especie/novo">Espécie</a></li>
  						<li><a href="{{action('VeterinarioController@formulario')}}">Veterinário</a></li>
					</ul>
				</li>
  				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Listar
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
  						<li><a href="{{action('ClienteController@lista')}}">Clientes</a></li>
  						<li><a href={{action('EspecieController@lista')}}>Espécies</a></li>
  						<li><a href="{{action('VeterinarioController@lista')}}">Veterinários</a></li>
					</ul>
				</li>
  				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Pesquisar
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
  						<li><a href="#">Cliente</a></li>
  						<li><a href="#">Veterinário</a></li>
					</ul>
				</li>
  				<li><a href="#">Marcar Consulta</a></li>
  				<li><a href="#">Visualizar Consultas</a></li>
  				@endif
  				@if($usuario == "VET")
  				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Histórico Consulta
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
  						<li><a href="#">Adicionar</a></li>
  						<li><a href="#">Listar</a></li>
  						<li><a href="#">Pesquisar</a></li>
					</ul>
				</li>
  				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Exame
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
  						<li><a href="#">Adicionar</a></li>
  						<li><a href="#">Listar</a></li>
  						<li><a href="#">Pesquisar</a></li>
					</ul>
				</li>
		    </ul>
		    @endif
		    <ul class="nav navbar-nav navbar-right">
		    	@if(Auth::guest())
  					<li><a href="/secretaria/novo"><span class="fa fa-sign-in"></span> Cadastre-se</a></li>
					<li><a href="/login"><span class="fa fa-user"></span> Login</a></li>
				@else
  					<li><a href="#"><span class="fa fa-user"></span> <strong>{{Auth::user()->name}}</strong></a></li>
					<li><a href="/logout"><span class="fa fa-sign-out"></span> Logout</a></li>
				@endif
		    </ul>
		</div>
	</nav>
	<div class="container">	
		@yield("conteudo")
	</div>
</body>
</html>