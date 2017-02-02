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
	<div class="spinner">
		<img src="/img/spinner.gif">
		<p>Aguarde...</p>
	</div>
	<input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
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
				<th></th>
				<th></th>
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
				<td class="text-center exame_realizado_coluna">
					<a href="#" class="exame_realizado">
						<i class="fa fa-check fa-2x" aria-hidden="true"></i>
					</a>
				</td>
				<td class="text-center">
					<a href="#" class="exclui_exame">
						<i class="fa fa-trash fa-2x" aria-hidden="true"></i>
					</a>
					</td>
				<input type="hidden" class="exame_id" value="{{$exame->id}}">
				<input type="hidden" class="analisado" value="{{$exame->analisado}}">
			</tr>
		@endforeach
		</tbody>
	</table>
@stop