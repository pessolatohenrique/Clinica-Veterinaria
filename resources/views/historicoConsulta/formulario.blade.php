@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Registrar Consulta Médica
@stop
@section("conteudo")
	<h1>Registrar Consulta Médica</h1>
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
	<form action="{{action('HistoricoConsultaController@adiciona')}}" method="POST">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="veterinario_id" value="{{Auth::user()->id}}">
		<fieldset>
			<legend>Dados do Cliente</legend>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label for="cpf">CPF</label>
						<input type="text" name="cpf" id="cpf_consulta_medica" class="form-control documento" value="" maxlength="14" value="{{old('cpf')}}">
					</div>
				</div>
				<div class="col-md-6">
					<label for="cliente_nome">Cliente</label>
					<input type="text" name="cliente_nome" id="cliente_consulta_medica" class="form-control erro-campo" disabled="" value="">
				</div>
				<div class="col-md-4">
					<label for="animal_id">Animal</label>
					<select class="form-control" name="animal_id" id="animais_consulta_medica">	
						<option value="">Selecione</option>
					</select>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Dados da Consulta</legend>
			<div class="row">
				<div class="col-md-2">
					<label for="data">Data de Realização</label>
					<input type="text" name="data" class="form-control data" 
					value="{{$dataAtual}}">
				</div>
				<div class="col-md-4">
					<label for="tratamento_encerrado">Tratamento encerrado?</label>
					<div class="radio">
						<label><input type="radio" name="tratamento_encerrado" value="1" checked>Sim</label>
						<label><input type="radio" name="tratamento_encerrado" value="0">Não</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 textarea-consulta">
					<label for="sintomas">Sintomas</label>
					<textarea name="sintomas" class="form-control">{{old('sintomas')}}</textarea>
				</div>
			</div>
			<div class="row textarea-consulta">
				<div class="col-md-12" style="margin-top:0.5em">
					<label for="diagnostico">Diagnóstico</label>
					<textarea name="diagnostico" class="form-control">{{old('diagnostico')}}</textarea>
				</div>
			</div>
			<div class="row textarea-consulta">
				<div class="col-md-12">
					<label for="tratamento">Tratamento</label>
					<textarea name="tratamento" class="form-control">{{old('tratamento')}}</textarea>
				</div>
			</div>
		</fieldset>
		<br>
		<button type="submit" class="btn btn-primary">Salvar</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
@stop