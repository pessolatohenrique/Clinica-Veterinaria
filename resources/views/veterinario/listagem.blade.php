@extends("layout/template")
@section("titulo")
	Listagem de Veterinários
@stop
@section("conteudo")
<h1>Veterinários Cadastrados</h1>
<p>Veterinários que trabalham nesta unidade da clínica</p>
@if(old("nome"))
	<p class="alert alert-success">Veterinário <strong>{{@old("nome")}}</strong> adicionado com sucesso!</p>
@endif
@if(old("veterinario_id"))
	<p class="alert alert-success">Veterinário excluído com sucesso!</p>
@endif
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
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($veterinarios as $veterinario)
			<tr>
				<td><a href="/veterinario/consulta/{{$veterinario->id}}">{{$veterinario->nome}}</a></td>
				<td>{{substr($veterinario->especialidade_descricao,0,15)}}</td>
				<td class="documento">{{$veterinario->crmv}}</td>
				<td>{{$veterinario->email}}</td>
				<td class="fone">{{$veterinario->telefone}}</td>
				<td class="fone">{{$veterinario->celular}}</td>
				<td class="horario">{{$veterinario->horaEntrada}}</td>
				<td class="horario">{{$veterinario->horaSaida}}</td>
				<td>
					<form action="/veterinario/apaga" method="POST">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="veterinario_id" value="{{$veterinario->id}}">
						<button type="submit" class="fa fa-trash fa-2x btn btn-link" name="btn_excluir"></button>
					</form>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endif
@stop
