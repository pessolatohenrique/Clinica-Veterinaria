@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Pesquisar Pagamento
@stop
@section("conteudo")
	<h1>Pesquisar Pagamento</h1>
	<p>Os campos não são de preenchimento obrigatório, permitindo a personalização da pesquisa.</p>
	<!-- Pesquisa de um pagto permitindo filtragem por cliente, data da consulta inicial e final, valor (acima de)!-->
	<form action="{{action('PagamentoController@lista')}}" method="GET">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="cpf">CPF</label>
					<input type="text" name="cpf" class="form-control documento">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="cliente">Cliente</label>
					<input type="text" name="cliente" class="form-control">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="dataInicial">Data Inicial</label>
					<input type="text" name="dataInicial" class="form-control data">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="dataFinal">Data Final</label>
					<input type="text" name="dataFinal" class="form-control data">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="valor">Valor (maior ou igual a) </label>
					<input type="text" name="valor" class="form-control dinheiro">
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Pesquisar</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
@stop