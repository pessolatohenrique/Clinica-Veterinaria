@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Histórico de Consultas
@stop
@section("conteudo")
	<h1>Consultas médicas Realizadas</h1>
	<p>Legenda:
		<strong class="text-success">O tratamento foi encerrado</strong>;
		<strong class="text-danger">O tratamento ainda está em andamento, ou seja, não foi encerrado</strong>
	</p>
	@if(session('adicionou'))
		<div class="alert alert-success">
			{{session('adicionou')}}
		</div>
	@endif
	@if(session('atualizou'))
		<div class="alert alert-success">
			{{session('atualizou')}}
		</div>
	@endif
	@if(session('excluiu'))
		<div class="alert alert-success">
			{{session('excluiu')}}
		</div>
	@endif
	@if(count($consultas_realizadas) == 0)
		<div class="alert alert-info">
			Nenhum resultado encontrado. Refaça a sua pesquisa!
		</div>
	@endif
	@if(count($consultas_realizadas) > 0)
		<table class="table table-bordered tabela-consultas-realizadas">
			<thead>
				<tr class="bg-info">
					<th class="bg-info">Data</th>
					<th>Cliente</th>
					<th>Animal</th>
					<th>Espécie</th>
					<th>Tipo de Animal</th>
					<th>Sintomas</th>
					<th>Diagnóstico</th>
					<th>Tratamento</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($consultas_realizadas as $consulta)
				<tr>
					<td>{{convertDateToBrazilian($consulta->data)}}</td>
					<td><?=substr($consulta->cliente_nome,0,20)?></td>
					<td>{{$consulta->animal_nome}}</td>
					<td>{{$consulta->especie_nome}}</td>
					<td>{{$consulta->tipo_animal}}</td>
					<td>{{substr($consulta->sintomas,0,20)}}</td>
					<td>{{$consulta->diagnostico}}</td>
					<td>{{substr($consulta->tratamento,0,140)}}</td>
					<td>
						<form action="/historicoConsulta/consulta" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="consulta_id" value="{{$consulta->id}}">
							<input type="hidden" name="animal_id" value="{{$consulta->animal_id}}">
							<button type="submit" class="fa fa-pencil fa-2x btn btn-link icone" name="btn_atualizar"></button>
						</form>
					</td>
					<td>
						<form action="/historicoConsulta/apaga" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="consulta_id" value="{{$consulta->id}}">
							<button type="submit" class="fa fa-trash fa-2x btn btn-link icone" name="btn_excluir"></button>
						</form>
					</td>
					<input type="hidden" class="tratamento_encerrado" value="{{$consulta->tratamento_encerrado}}">
				</tr>
				@endforeach
			</tbody>
		</table>
	@endif
@stop