<!DOCTYPE html>
<html>
<head>
	<title>@yield("titulo")</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" type="text/css" href="/css/custom.css">
	<script type="text/javascript" src="/js/jquery-1.12.1.min.js"></script>
	<script type="text/javascript" src="/js/jquery.mask.js"></script>
	<script type="text/javascript" src="/js/geral.js"></script>
	<script src="https://use.fontawesome.com/b17cc3a995.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
	    	<div class="navbar-header">
		    	<a class="navbar-brand" href="#">WebSiteName</a>
		    </div>
		    <ul class="nav navbar-nav">
  				<li class="active"><a href="#">Home</a></li>
  				<li><a href="#">Page 1</a></li>
  				<li><a href="#">Page 2</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		    	@if(Auth::guest())
  					<li><a href="#"><span class="fa fa-sign-in"></span> Cadastre-se</a></li>
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