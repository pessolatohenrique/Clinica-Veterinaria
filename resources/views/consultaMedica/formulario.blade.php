@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Marcar Consulta
@stop
@section("conteudo")
	<h1 class="altera_consulta_medica">{{isset($consulta_medica->id)?"Alterar Consulta Médica":"Marcar Consulta"}}</h1>
	<p>
		@if(!isset($consulta_medica->id))
			Agendar uma nova consulta médica
		@else
			Atualizar dados de uma consulta. 
			<strong>Atenção: Para atualizar corretamente os dados da consulta, selecione novamente o animal que passará por esta</strong>
		@endif
	</p>
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
	<form action="
	{{isset($consulta_medica->id)?action('ConsultaMedicaController@atualiza'):action('ConsultaMedicaController@adiciona')}}" method="POST">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" id="cliente_id_consulta" value="{{isset($consulta_medica->id)?$consulta_medica->cliente_id:''}}">
		<input type="hidden" id="animal_id_consulta" value="{{isset($consulta_medica->id)?$consulta_medica->animal_id:''}}">
		<input type="hidden" name="consulta_id" value="{{isset($consulta_medica->id)?$consulta_medica->id:''}}"></input>
		<fieldset>
			<legend>Dados do Cliente</legend>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label for="cpf">CPF</label>
						<input type="text" name="cpf" id="cpf_consulta_medica" class="form-control documento" 
						value="{{isset($consulta_medica->id)?$consulta_medica->cliente_cpf:old('cpf')}}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="cliente_nome">Cliente</label>
						<input type="text" name="cliente_nome" id="cliente_consulta_medica" class="form-control" disabled
						value="{{isset($consulta_medica->id)?$consulta_medica->cliente_nome:old('cliente')}}">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="animal_id">Animal</label>
						<select class="form-control" name="animal_id" id="animais_consulta_medica">
							<option value="">Selecione</option>
						</select>
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Dados da Consulta Médica</legend>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label for="data">Data</label>
						<input type="text" name="data" class="form-control data" 
						value="{{isset($consulta_medica->id)?convertDateToBrazilian($consulta_medica->data):old('data')}}">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="horario">Horário</label>
						<input type="text" name="horario" class="form-control horario"
						value="{{isset($consulta_medica->id)?substr($consulta_medica->horario,0,5):old('horario')}}">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="motivo_id">Motivo</label>
						<select class="form-control" name="motivo_id">
							<option value="">Selecione</option>
							@foreach($motivos as $motivo)
								<option value="{{$motivo->id}}"
								<?=(isset($consulta_medica->id) && $motivo->id == $consulta_medica->motivo_id)?"selected":""?>>
									{{$motivo->motivo}}
								</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="veterinario_id">Veterinário</label>
						<select class="form-control" name="veterinario_id">
							<option value="">Selecione</option>
							@foreach($veterinarios as $veterinario)
								<option value="{{$veterinario->id}}"
								<?=(isset($consulta_medica->id) && $veterinario->id == $consulta_medica->veterinario_id)?"selected":""?>>
									{{$veterinario->nome}} ({{$veterinario->especialidade_descricao}})
								</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="observacao">Observações</label>
						<textarea name="observacao" class="form-control" rows="4">{{isset($consulta_medica->id)?$consulta_medica->observacao:old('observacao')}}</textarea>
					</div>
				</div>
			</div>
		</fieldset>
		<button type="submit" class="btn btn-primary">Salvar</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
@stop