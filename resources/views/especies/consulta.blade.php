@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Espécie
@stop
@section("conteudo")
	<h1>Espécie: {{$especie->nome}}</h1>
	<p>
		<strong>Tipo de Animal: </strong>{{$especie->tipo_animal_nome}}<br>
		<strong>Descrição: </strong><br>
		{{$especie->descricao}}
	</p>
@stop