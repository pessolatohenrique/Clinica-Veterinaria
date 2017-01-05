@extends("layout/template")
@section("titulo")
Veterinário | Formulário
@stop
@section("conteudo")
<h1>{{isset($veterinario->cpf)?"Veterinário: $veterinario->nome":"Adicionar Veterinário"}}</h1>
<form action="{{isset($veterinario->cpf)?'/veterinario/atualiza':'/veterinario/adiciona'}}" method="POST">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<input type="hidden" name="veterinario_id" value="{{isset($veterinario->id)?$veterinario->id:''}}">
	<fieldset>
		<legend>Dados de Cadastro</legend>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="cpf">CPF</label>
					<input type="text" name="cpf" id="cpf" class="form-control documento" maxlength="15"
					value="{{isset($veterinario->cpf)?$veterinario->cpf:''}}">
				</div>
			</div>	
			<div class="col-md-2">
				<div class="form-group">
					<label for="crmv">CRMV</label>
					<input type="text" name="crmv" id="crmv" class="form-control documento" maxlength="15"
					value="{{isset($veterinario->crmv)?$veterinario->crmv:''}}">
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" name="nome" id="nome" class="form-control"
					value="{{isset($veterinario->nome)?$veterinario->nome:''}}">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="form-control"
					value="{{isset($veterinario->email)?$veterinario->email:''}}">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="telefone">Telefone</label>
					<input type="text" name="telefone" id="telefone" class="form-control fone"
					value="{{isset($veterinario->telefone)?$veterinario->telefone:''}}">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="celular">Celular</label>
					<input type="text" name="celular" id="celular" class="form-control celular"
					value="{{isset($veterinario->celular)?$veterinario->celular:''}}">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="especialidade">Especialidade</label>
					<select name="especialidade_id" class="form-control">
						<option value="">Selecione</option>
						@foreach($especialidades as $item)
							<?php $selecionado = isset($veterinario->especialidade_id) && $veterinario->especialidade_id == $item->id?'selected':'' ?>
							<option value="{{$item->id}}" {{$selecionado}}>
								{{$item->nome}}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="dataAdmissao">Data de Contratação</label>
					<input type="text" name="dataAdmissao" id="dataAdmissao" class="form-control data" maxlength="10"
					value="{{isset($veterinario->dataAdmissao)?$veterinario->dataAdmissao:''}}">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="horaEntrada">Horário de Entrada</label>
					<input type="time" name="horaEntrada" id="horaEntrada" class="form-control" maxlength="5"
					value="{{isset($veterinario->horaEntrada)?$veterinario->horaEntrada:''}}">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="horaSaida">Horário de Saída</label>
					<input type="time" name="horaSaida" id="horaSaida" class="form-control" maxlength="5"
					value="{{isset($veterinario->horaSaida)?$veterinario->horaSaida:''}}">
				</div>
			</div>
		</div>
	</fieldset>
	@if(!isset($veterinario->cpf))
	<fieldset>
		<legend>Login</legend>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="login">Login</label>
					<input type="text" name="login" id="login" class="form-control">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="password" name="senha" id="senha" class="form-control">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="confirmaSenha">Confirme a senha</label>
					<input type="password" name="confirmaSenha" id="confirmaSenha" class="form-control">
				</div>
			</div>
		</div>
	</fieldset>
	@endif
	<button type="submit" class="btn btn-primary">Salvar</button>
	<button type="reset" class="btn btn-warning">Limpar</button>
</form>
@stop