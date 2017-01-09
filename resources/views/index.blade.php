@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Home
@stop
@section("conteudo")
	<h1>Página Inicial</h1>
	<p>Aqui ficará o conteúdo da página inicial</p>
	@if(Session::has('msgAutorizacao'))
		<div class="alert alert-danger">
			{{Session::get('msgAutorizacao')}}
		</div>
	@endif
@stop