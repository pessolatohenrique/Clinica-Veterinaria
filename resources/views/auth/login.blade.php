@extends('layout/template')
@section("titulo")
Clínica Veterinária | Login
@stop
@section("conteudo")
	<h1>Login</h1>
	@if(old("email"))
		<p class="alert alert-danger">Usuário ou senha incorretos. Verifique o seu login!</p>
	@endif
	@if(old("deslogou"))
		<p class="alert alert-success">Usuário deslogado com sucesso!</p>
	@endif
	<form action="/login" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="email">E-mail</label>
			<input type="email" class="form-control" name="email" value="{{ old('email') }}">
		</div>
		<div class="form-group">
			<label for="password">Senha</label>
			<input type="password" class="form-control" name="password">
		</div>
		<button type="submit" class="btn btn-primary">Login</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
@stop
