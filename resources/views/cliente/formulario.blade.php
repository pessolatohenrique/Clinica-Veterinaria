@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Cliente
@stop
@section("conteudo")
	@if(count($errors) > 0)
		<div class="alert alert-danger">
			<h4>Fique atento aos seguintes erros!</h4>
			<ul>
			@foreach($errors->all() as $erro)
				<li>{{$erro}}</li>
			@endforeach
			</ul>
		</div>
	@endif
	<h1>Cadastrar Cliente</h1>
	<form action="/cliente/adiciona" method="POST">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<fieldset>
			<legend>Dados Pessoais</legend>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label for="cpf">CPF</label>
						<input type="text" name="cpf" id="cpf" class="form-control documento"
						value="{{old('cpf')}}">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="rg">RG</label>
						<input type="text" name="rg" id="rg" class="form-control rg"
						value="{{old('rg')}}">
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" name="nome" id="nome" class="form-control"
						value="{{old('nome')}}">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="telefone">Telefone</label>
					<input type="text" name="telefone" id="telefone" class="form-control fone"
					value="{{old('telefone')}}">
				</div>
				<div class="col-md-2">
					<label for="celular">Celular</label>
					<input type="text" name="celular" id="celular" class="form-control celular"
					value="{{old('celular')}}">
				</div>
				<div class="col-md-8">
					<label for="email">E-mail</label>
					<input type="email" name="email" id="email" class="form-control"
					value="{{old('email')}}">
				</div>
			</div>
		</fieldset>
		<fieldset style="margin-top:1em">
			<legend>Endereço</legend>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label for="cep">CEP</label>
						<input type="text" name="cep" id="cep_formulario" class="form-control"
						value="{{old('cep')}}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="logradouro">Logradouro</label>
						<input type="text" name="logradouro" id="logradouro_formulario" class="form-control"
						value="{{old('logradouro')}}"> 
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="numero">Número</label>
						<input type="number" name="numero" id="numero_formulario" class="form-control"
						value="{{old('numero')}}">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="complemento">Complemento</label>
						<input type="text" name="complemento" id="complemento_formulario" class="form-control"
						value="{{old('complemento')}}">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="bairro">Bairro</label>
						<input type="text" name="bairro" id="bairro_formulario" class="form-control"
						value="{{old('bairro')}}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="cidade">Cidade</label>
						<input type="text" name="cidade" id="cidade_formulario" class="form-control"
						value="{{old('cidade')}}">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="estado">Estado</label>
						<input type="text" name="estado" id="estado_formulario" class="form-control" maxlength="2"
						value="{{old('estado')}}">
					</div>
				</div>
			</div>
		</fieldset>
		<button type="submit" class="btn btn-primary">Salvar</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
@stop