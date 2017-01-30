@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Histórico de Consultas
@stop
@section("conteudo")
	<h1>Consultas médicas Realizadas</h1>
	<table class="table table-bordered tabela-consultas-realizadas">
	<!--Listagem de **todas** as consultas realizadas (com **where** no veterinário_id logado), com os campos: data, cliente, animal, espécie, tipo de animal, sintomas, diagnóstico, tratamento, encerrado (boolean) - SIM ou NÃO!-->
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
				<th>Encerrado</th>
			</tr>
		</thead>
		<tbody>
			@for($i=0;$i < 5;$i++)
			<tr>
				<td>26/01/2017</td>
				<td>Henrique Pessolato</td>
				<td>Barry</td>
				<td>Maine Coon</td>
				<td>Gato</td>
				<td>Não dorme</td>
				<td>Febre</td>
				<td>Remédios</td>
				<td>NÃO</td>
			</tr>
			@endfor
		</tbody>
	</table>
@stop