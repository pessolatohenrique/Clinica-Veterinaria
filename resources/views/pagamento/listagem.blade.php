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
				<th>Valor</th>
				<th>Cliente</th>
				<th>Animal</th>
				<th>Sintomas</th>
				<th>Diagnóstico</th>
				<th>Tratamento</th>
			</tr>
		</thead>
		<tbody>
		@for($i = 0; $i < 4; $i++)
			<tr>
				<td>01/02/2017</td>
				<td>R$ 120,00</td>
				<td>Henrique Pessolato</td>
				<td>Barry</td>
				<td>Dor de cabeça, febre</td>
				<td>Febre</td>
				<td>Vacina contra a febre</td>
				<input type="hidden" name="status" id="status_pagto" value="1">
			</tr>
		@endfor
		</tbody>
	</table>
@stop