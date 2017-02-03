@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Pesquisar Exame
@stop
@section("conteudo")
	<h1>Pesquisar Exame</h1>
	<p>Os campos não são de preenchimento obrigatório, permitindo a personalização da pesquisa.</p>
	<form action="{{action('ExameController@lista')}}" method="GET">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="data_inicial">Data Inicial</label>
					<input type="text" name="data_inicial" class="form-control data">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="data_final">Data Final</label>
					<input type="text" name="data_final" class="form-control data">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="cpf">CPF</label>
					<input type="text" name="cpf" class="form-control documento">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="cliente">Cliente</label>
					<input type="text" name="cliente" class="form-control">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<label for="exame">Exame</label>
				<input type="text" name="exame" class="form-control">
			</div>
			<div class="col-md-6">
				<label for="objetivo">Objetivo</label>
				<input type="text" name="objetivo" class="form-control">
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="analisado">Exame Analisado?</label>
					<select class="form-control" name="analisado">
						<option value="">Indiferente</option>
						<option value="1">Sim</option>
						<option value="0">Não</option>
					</select>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Pesquisar</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
@stop