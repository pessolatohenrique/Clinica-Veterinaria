@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Pagamentos
@stop
@section("conteudo")
	<h1>Listagem de Pagamentos</h1>
	<p>Para melhorar a filtragem de pagamentos, como por exemplo: por cliente, por status, por valor, entre outros, utilize a <a href="/pagamento/pesquisa">pesquisa</a>.</p>
	<!-- Listagem de pagamentos, com os campos: cliente, data da consulta, valor, animal, sintomas, diagnostico, tratamento!-->
	<table class="table table-bordered">
		<thead>
			<tr class="bg-info">
				<th>Data</th>
				<th>Valor (R$)</th>
				<th>Cliente</th>
				<th>Animal</th>
				<th>Sintomas</th>
				<th>Diagnóstico</th>
				<th>Tratamento</th>
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
				<input type="hidden" name="status" id="status_pagto" value="{{$pagamento->status}}">
			</tr>
		@endforeach
		</tbody>
	</table>
@stop