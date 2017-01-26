@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Consultas Marcadas
@stop
@section("conteudo")
	<h1>Consultas Marcadas</h1>
	<p>Consultas médicas a serem realizadas</p>
	@if(Session::has('msgSucesso'))
		<div class="alert alert-success">
			{{Session::get('msgSucesso')}}
		</div>
	@endif
	@if(Session::has('msgAtualizou'))
		<div class="alert alert-success">
			{{Session::get('msgAtualizou')}}
		</div>
	@endif
	<table class="table table-bordered tabela-consulta-medica">
		<thead>
			<tr>
				<th class="bg-info">Data</th>
				<th class="bg-info">Horário</th>
				<th class="bg-info">Dias</th>
				<th class="bg-info">Motivo</th>
				<th class="bg-info">Veterinário</th>
				<th class="bg-info">Observação</th>
				<th class="bg-warning">Animal</th>
				<th class="bg-warning">Espécie do Animal</th>
				<!-- <th class="bg-warning">Tipo do Animal</th> -->
				<th class="bg-success">CPF</th>
				<th class="bg-success">Cliente</th>
				<th class="bg-success">Telefones</th>
				<th class="bg-primary"></th>
				<th class="bg-primary"></th>
			</tr>
		</thead>
		<tbody>
			@foreach($consultas_medicas as $consulta)
			<tr class="text-center">
				<td>{{convertDateToBrazilian($consulta->data)}}</td>
				<td>{{substr($consulta->horario,0,5)}}</td>
				<td>{{$consulta->dias_restantes}}</td>
				<td>{{$consulta->motivo_descricao}}</td>
				<td>
					<a href="/veterinario/consulta/{{$consulta->veterinario_id}}">{{substr($consulta->veterinario_nome,0,21)}}</a>
				</td>
				<td>{{$consulta->observacao!=""?$consulta->observacao:"Não Informado"}}</td>
				<td>{{$consulta->animal_nome}}</td>
				<td><a href="/especie/{{$consulta->especie_id}}">{{substr($consulta->especie_nome,0,11)}} ({{$consulta->tipo_animal_descricao}})</a></td>
				<!-- <td>{{$consulta->tipo_animal_descricao}}</td> -->
				<td class="documento">{{$consulta->cliente_cpf}}</td>
				<td><a href="/cliente/{{$consulta->cliente_id}}">{{substr($consulta->cliente_nome,0,21)}}</a></td>
				<td>
					<span class="fone">{{$consulta->telefone}}</span>; <span class="celular">{{$consulta->celular}}</span>
				</td>
				<td>
					<form action="/consultaMedica/consulta" method="POST">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="consulta_id" value="{{$consulta->id}}">
						<button type="submit" class="fa fa-pencil fa-2x btn btn-link icone" name="btn_atualizar"></button>
					</form>
				</td>
				<td>
					<form action="/consultaMedica/apaga" method="POST">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="consulta_id" value="{{$consulta->id}}">
						<button type="submit" class="fa fa-trash fa-2x btn btn-link icone" name="btn_excluir"></button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@stop