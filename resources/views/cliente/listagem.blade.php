@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Clientes
@stop
@section("conteudo")
	<h1>Listagem de Clientes</h1>
	<!-- Listagem de Clientes (campos: nome, cpf, email, telefone, celular, logradouro+numero,bairro,cidade+estado) -->
	<table class="table table-bordered table-hover tabela-cliente">
		<thead>
			<tr>
				<th>Nome</th>
				<th>CPF</th>
				<th>Email</th>
				<th>Telefone</th>
				<th>Celular</th>
				<th>Logradouro</th>
				<th>Bairro</th>
				<th>Cidade</th>
			</tr>
		</thead>
		<tbody>
			@foreach($clientes as $cliente)
				<tr>
					<td>{{$cliente->nome}}</td>
					<td class="documento">{{$cliente->cpf}}</td>
					<td>{{$cliente->email}}</td>
					<td class="fone">{{$cliente->telefone}}</td>
					<td class="celular">{{$cliente->celular}}</td>
					<td>{{$cliente->logradouro}},{{$cliente->numero}}</td>
					<td>{{$cliente->bairro}}</td>
					<td>{{$cliente->cidade}}/{{$cliente->estado}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop