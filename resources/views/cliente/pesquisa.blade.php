@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Pesquisar Cliente
@stop
@section("conteudo")
	<h1>Pesquisar Cliente</h1>
	<p>
		Nenhum campo é de preenchimento obrigatório. Sendo assim, é possível pesquisar preenchendo apenas um dos campos.
		Exemplo: realizar busca via CPF, RG ou nome
	</p>
	<form action="/cliente" method="GET">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="cpf">CPF</label>
					<input type="text" name="cpf" id="cpf" class="form-control documento"
					value="">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="rg">RG</label>
					<input type="text" name="rg" id="rg" class="form-control rg"
					value="">
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" name="nome" id="nome" class="form-control"
					value="">
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Pesquisar</button>
		<button type="submit" class="btn btn-warning">Limpar</button>
	</form>
@stop