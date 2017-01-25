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
	<table class="table table-bordered tabela-consulta-medica">
		<thead>
			<tr>
				<th class="bg-info">Data</th>
				<th class="bg-info">Horário</th>
				<th class="bg-info">Motivo</th>
				<th class="bg-info">Veterinário</th>
				<th class="bg-info">Observação</th>
				<th class="bg-warning">Animal</th>
				<th class="bg-warning">Espécie do Animal</th>
				<th class="bg-warning">Tipo do Animal</th>
				<th class="bg-success">CPF</th>
				<th class="bg-success">Cliente</th>
				<th class="bg-success">Telefones</th>
			</tr>
		</thead>
		<tbody>
			@for($i=0;$i < 5; $i++)
			<tr class="text-center">
				<td>02/02/2017</td>
				<td>15:00</td>
				<td>Enfermidade</td>
				<td>Caitlin Snow</td>
				<td>Cachorro está com febre</td>
				<td>Barry</td>
				<td>Yorkshire</td>
				<td>Cachorro</td>
				<td>012.345.578-90</td>
				<td>Henrique Pessolato</td>
				<td>(11) 4220-4386; (11) 97381-7302</td>
			</tr>
			@endfor
		</tbody>
	</table>
@stop