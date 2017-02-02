@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Exames
@stop
@section("conteudo")
	<h1>Exames Marcados</h1>
	<p>Listagem de exames marcados durante uma consulta médica.
		<br>
		<strong>Legenda:</strong> <span class="text-success"><strong>Exames já analisados</strong></span>;
		<span class="text-danger"><strong>Exames ainda não analisados</strong></span>
	</p>
	<table class="table table-bordered tabela_exames_interno">
		<thead>
			<tr class="bg-info">
				<th>Data</th>
				<th>Cliente</th>
				<th>Animal</th>
				<th>Espécie</th>
				<th>Tipo de Animal</th>
				<th>Nome do Exame</th>
				<th>Objetivo do Exame</th>
			</tr>
		</thead>
		<tbody>
		@foreach($exames as $exame)
			<tr>
				<td>{{convertDateToBrazilian($exame->data_consulta)}}</td>
				<td>{{$exame->cliente_nome}}</td>
				<td>{{$exame->animal_nome}}</td>
				<td>{{$exame->especie_nome}}</td>
				<td>{{$exame->tipo_animal}}</td>
				<td>{{$exame->nome}}</td>
				<td>{{$exame->objetivo}}</td>
				<input type="hidden" id="analisado" value="{{$exame->analisado}}">
			</tr>
		@endforeach
		</tbody>
	</table>
@stop