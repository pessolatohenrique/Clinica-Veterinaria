@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Clientes
@stop
@section("conteudo")
	<h1>Listagem de Clientes</h1>
	@if(old("nome"))
		<div class="alert alert-success">
			O cliente <strong>{{old("nome")}}</strong> foi adicionado/atualizado com sucesso!
		</div>
	@endif
	@if(count($clientes) == 0)
		<div class="alert alert-info">
			Nenhum cliente encontrado. Refaça a sua busca!
		</div>
	@endif
	@if(count($clientes) > 0)
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
						<td class="nome_cliente"><a href="/cliente/{{$cliente->cliente_id}}">{{$cliente->nome}}</a></td>
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
	@endif
	<script type="text/javascript">
		$(document).ready(function(){
			var quantidade = $(".nome_cliente").length;
			if(quantidade == 1){
				var endereco = $(".nome_cliente a").attr("href");
				window.location.href = endereco;
			}
		});
	</script>
@stop