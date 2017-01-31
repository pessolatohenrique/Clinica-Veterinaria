@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Pesquisa de Consulta Médica
@stop
@section("conteudo")
	<h1>Pesquisar Consulta Médica</h1>
	<p>Preencha ao menos um dos campos abaixo para realizar a pesquisa. Nenhum campo é de preenchimento obrigatório</p>
	<!--
Pesquisa de uma consulta por data inicial e data final, cliente, veterinário, faixa de horário
	!-->
	<form action="/consultaMedica" method="GET">
		<fieldset>
			<legend>Datas e Horários</legend>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="dataInicial">Data de Início</label>
						<input type="text" name="dataInicial" class="form-control data" maxlength="10">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="dataFinal">Data Final</label>
						<input type="text" name="dataFinal" class="form-control data" maxlength="10">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="horaInicial">Horário Inicial</label>
						<input type="text" name="horaInicial" class="form-control horario" maxlength="5">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="horaFinal">Horário Final</label>
						<input type="text" name="horaFinal" class="form-control horario" maxlength="5">
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Cliente e Veterinário</legend>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label for="cpf_pesquisa">CPF do Cliente</label>
						<input type="text" name="cpf_pesquisa" class="form-control documento">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nome_cliente_pesquisa">Cliente</label>
						<input type="text" name="nome_cliente_pesquisa" id="nome_cliente_pesquisa" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="veterinario_pesquisa">Veterinário</label>
						<select class="form-control" name="veterinario_pesquisa">
							<option value="">Todos</option>
							@foreach($veterinarios as $veterinario)
								<option value="{{$veterinario->id}}">{{$veterinario->nome}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</fieldset>
		<button type="submit" class="btn btn-primary">Pesquisar</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
	
@stop