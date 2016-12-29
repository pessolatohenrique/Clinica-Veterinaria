@extends("layout/template")
@section("titulo")
	Listagem de Veterinários
@stop
@section("conteudo")
<h1>Veterinários Cadastrados</h1>
<p>Veterinários que trabalham nesta unidade da clínica</p>
@if(empty($veterinarios))
	<p class="alert alert-info">Nenhum veterinário encontrado. Refaça a sua busca!</p>
@else
<table class="table table-bordered tabela-veterinario">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Especialidade</th>
			<th>CRMV</th>
			<th>E-mail</th>
			<th>Telefone</th>
			<th>Celular</th>
			<th>Horário Inicial</th>
			<th>Horário Final</th>
		</tr>
	</thead>
	<tbody>
		@foreach($veterinarios as $veterinario)
			<tr>
				<td><a href="veterinario/consulta/{{$veterinario->id}}">{{$veterinario->nome}}</a></td>
				<td>{{substr($veterinario->especialidade_descricao,0,15)}}</td>
				<td class="documento">{{$veterinario->crmv}}</td>
				<td>{{$veterinario->email}}</td>
				<td class="fone">{{$veterinario->telefone}}</td>
				<td class="fone">{{$veterinario->celular}}</td>
				<td class="horario">{{$veterinario->horaEntrada}}</td>
				<td class="horario">{{$veterinario->horaSaida}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endif
@stop
