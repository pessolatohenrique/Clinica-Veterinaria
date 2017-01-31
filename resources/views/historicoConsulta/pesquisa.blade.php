@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Pesquisar Consulta Médica
@stop
@section("conteudo")
	<h1>Pesquisar Consulta Médica</h1>
	<p>Preencha ao menos um dos campos abaixo para realizar a pesquisa. Nenhum campo é de preenchimento obrigatório.</p>
	<form action="{{action('HistoricoConsultaController@lista')}}" method="GET">
		<fieldset>
			<legend>Dados Gerais</legend>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label for="dataInicio">Data Inicial</label>
						<input type="text" name="dataInicio" class="form-control data">
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
						<label for="cpf_cliente">CPF do Cliente</label>
						<input type="text" name="cpf_cliente" class="form-control documento">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nome_cliente">Nome do Cliente</label>
						<input type="text" name="nome_cliente" id="nome_cliente_pesquisa" class="form-control">
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Específicos da Consulta</legend>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="sintomas">Sintomas</label>
						<input type="text" name="sintomas" class="form-control">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="diagnostico">Diagnóstico</label>
						<input type="text" name="diagnostico" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="tratamento">Tratamento</label>
						<input type="text" name="tratamento" class="form-control">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="tratamento_encerrado">Tratamento encerrado?</label>
						<select name="tratamento_encerrado" class="form-control">
							<option value="">Selecione</option>
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</select>
					</div>
				</div>
			</div>
		</fieldset>
		<button type="submit" class="btn btn-primary">Pesquisar</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
@stop