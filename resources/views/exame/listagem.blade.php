@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Exames
@stop
@section("conteudo")
	<h1>Exames Marcados</h1>
	<p>Listagem de exames marcados durante uma consulta médica.</p>
	<!-- 

	Listagem de exames marcados (**todos para um veterinário**) com os campos: data de solicitação (**link para consulta**), Cliente, Animal, Espécie, Tipo de Animal, nome do exame, objetivo, analisado (colorir)
	!-->
	<table class="table table-bordered tabela-exames">
		<thead>
			<tr class="bg-info">
				<th>Data</th>
				<th>Cliente</th>
				<th>Animal</th>
				<th>Espécie</th>
				<th>Tipo de Animal</th>
				<th>Nome do Exame</th>
				<th>Objetivo do Exame</th>
			</tr>
		</thead>
		<tbody>
		@for($i = 0; $i < 5; $i++)
			<tr>
				<td>01/02/2017</td>
				<td>Henrique Pessolato</td>
				<td>Barry</td>
				<td>Maine Coon</td>
				<td>Gato</td>
				<td>Exame de Sangue</td>
				<td>Verificar sintomas gerais do animal</td>
			</tr>
		@endfor
		</tbody>
	</table>
@stop