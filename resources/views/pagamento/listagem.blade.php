@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Pagamentos
@stop
@section("conteudo")
	<h1>Listagem de Pagamentos</h1>
	<input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
	<p>
		Para melhorar a filtragem de pagamentos, como por exemplo: por cliente, por status, por valor, entre outros, utilize a <a href="/pagamento/pesquisa">pesquisa</a>.
		<br>
		O <strong>total à receber</strong> é calculado de acordo com a pesquisa realizada.
		<br>
		Legenda: <strong><span class="text-success">Pago</span></strong>; <strong><span class="text-danger">Não Pago</span></strong>
	</p>
	<div class="spinner">
		<img src="/img/spinner.gif">
		<p>Aguarde...</p>
	</div>
	<table class="table table-bordered tabela-pagamentos">
		<thead>
			<tr class="bg-info">
				<th>Data</th>
				<th>Valor (R$)</th>
				<th>Cliente</th>
				<th>Animal</th>
				<th>Sintomas</th>
				<th>Diagnóstico</th>
				<th>Tratamento</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($pagamentos as $pagamento)
			<tr>
				<td>{{convertDateToBrazilian($pagamento->data)}}</td>
				<td class="dinheiro text-center">{{$pagamento->valor}}</td>
				<td>{{$pagamento->cliente_nome}}</td>
				<td>{{$pagamento->animal_nome}}</td>
				<td>{{substr($pagamento->sintomas,0,30)}}</td>
				<td>{{$pagamento->diagnostico}}</td>
				<td>{{substr($pagamento->tratamento,0,41)}}</td>
				<td>
					<a href="#" class="pagamento_realizado">
						<i class="fa fa-check fa-2x" aria-hidden="true"></i>
					</a>
				</td>
				<input type="hidden" name="pagamento_id" class="pagamento_id" value="{{$pagamento->id}}">
				<input type="hidden" name="status" class="status_pagto" value="{{$pagamento->status}}">
			</tr>
		@endforeach
			<tr class="bg-primary">
				<td colspan="8">
					Total à receber: <span class="total_receber">R$ 000.000.000,00</span>; referente à 
					<span class="quantidade_receber">00</span> consultas médicas
				</td>
			</tr>
		</tbody>
	</table>
@stop