@extends("layout/template")
@section("titulo")
Veterinário | Formulário
@stop
@section("conteudo")
<h1>Adicionar Veterinário</h1>
<form action="/veterinario/adiciona" method="POST">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<fieldset>
		<legend>Dados de Cadastro</legend>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="cpf">CPF</label>
					<input type="text" name="cpf" id="cpf" class="form-control documento" maxlength="15">
				</div>
			</div>	
			<div class="col-md-2">
				<div class="form-group">
					<label for="crmv">CRMV</label>
					<input type="text" name="crmv" id="crmv" class="form-control documento" maxlength="15">
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" name="nome" id="nome" class="form-control">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="form-control">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="telefone">Telefone</label>
					<input type="text" name="telefone" id="telefone" class="form-control fone">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="celular">Celular</label>
					<input type="text" name="celular" id="celular" class="form-control celular">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="especialidade">Especialidade</label>
					<select name="especialidade" class="form-control">
						<option value="">Selecione</option>
						@foreach($especialidades as $item)
							<option value="{{$item->id}}">{{$item->nome}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="dataAdmissao">Data de Contratação</label>
					<input type="text" name="dataAdmissao" id="dataAdmissao" class="form-control data" maxlength="10">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="horaEntrada">Horário de Entrada</label>
					<input type="time" name="horaEntrada" id="horaEntrada" class="form-control" maxlength="5">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="horaSaida">Horário de Saída</label>
					<input type="time" name="horaSaida" id="horaSaida" class="form-control" maxlength="5">
				</div>
			</div>
		</div>
	</fieldset>
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
	<button type="submit" class="btn btn-primary">Salvar</button>
	<button type="reset" class="btn btn-warning">Limpar</button>
</form>
@stop