@extends("layout/template")
@section("titulo")
	Clínica Veterinária | {{isset($consulta_realizada->id)?"Modificar Consulta Médica":"Registrar Consulta Médica"}}
@stop
@section("conteudo")
	<h1 class="altera_consulta_medica">{{isset($consulta_realizada->id)?"Atualizar Consulta Médica":"Registrar Consulta Médica"}}</h1>
	@if(isset($consulta_realizada->id))
		<p><strong>Importante: </strong>Para atualizar corretamente, selecione novamente o animal que passou por consulta</p>
	@endif
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
	<form action="{{isset($consulta_realizada->id)?action('HistoricoConsultaController@atualiza'):action('HistoricoConsultaController@adiciona')}}" method="POST">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="veterinario_id" value="{{Auth::user()->id}}">
		<input type="hidden" name="consulta_id" id="consulta_id" value="{{isset($consulta_realizada->id)?$consulta_realizada->id:''}}">
		<input type="hidden" id="cliente_id_consulta" value="{{isset($consulta_realizada->id)?$consulta_realizada->cliente_id:''}}">
		<fieldset>
			<legend>Dados do Cliente</legend>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label for="cpf">CPF</label>
						<input type="text" name="cpf" id="cpf_consulta_medica" class="form-control documento" maxlength="14" 
						value="{{isset($consulta_realizada->id)?$consulta_realizada->cliente_cpf:old('cpf')}}">
					</div>
				</div>
				<div class="col-md-6">
					<label for="cliente_nome">Cliente</label>
					<input type="text" name="cliente_nome" id="cliente_consulta_medica" class="form-control erro-campo" disabled="" 
					value="{{isset($consulta_realizada->id)?$consulta_realizada->cliente_nome:''}}">
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
					<input type="text" name="data" class="form-control data" id="data_consulta"
					value="{{isset($consulta_realizada->id)?convertDateToBrazilian($consulta_realizada->data):$dataAtual}}">
				</div>
				<div class="col-md-4">
					<label for="tratamento_encerrado">Tratamento encerrado?</label>
					<div class="radio">
						<label><input type="radio" name="tratamento_encerrado" value="1" 
						<?php 
							if((isset($consulta_realizada) && $consulta_realizada->tratamento_encerrado == 1) 
								|| (!isset($consulta_realizada->id))):
								echo "checked";
							endif;
						?>>Sim</label>
						<label><input type="radio" name="tratamento_encerrado" value="0"
						<?php 
							if(isset($consulta_realizada) && $consulta_realizada->tratamento_encerrado == 0):
								echo "checked";
							endif;
						?>
						>Não</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 textarea-consulta">
					<label for="sintomas">Sintomas</label>
					<textarea name="sintomas" class="form-control">{{isset($consulta_realizada->id)?$consulta_realizada->sintomas:old('sintomas')}}</textarea>
				</div>
			</div>
			<div class="row textarea-consulta">
				<div class="col-md-12" style="margin-top:0.5em">
					<label for="diagnostico">Diagnóstico</label>
					<textarea name="diagnostico" class="form-control">{{isset($consulta_realizada->id)?$consulta_realizada->diagnostico:old('diagnostico')}}</textarea>
				</div>
			</div>
			<div class="row textarea-consulta">
				<div class="col-md-12">
					<label for="tratamento">Tratamento</label>
					<textarea name="tratamento" class="form-control">{{isset($consulta_realizada->id)?$consulta_realizada->tratamento:old('tratamento')}}</textarea>
				</div>
			</div>
		</fieldset>
		<br>
		<button type="submit" class="btn btn-primary">Salvar</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
	<!-- Formulário e listagem de exames !-->
	@if(isset($consulta_realizada->id))
	<fieldset style="margin-top:1em">
		<legend>Exames Solicitados</legend>
		<p>
			Exames solicitados para o animal <strong>{{$consulta_realizada->animal_nome}}</strong>, do(a) cliente 
			<strong>{{$consulta_realizada->cliente_nome}}</strong>
			<br>
			<strong>Legenda:</strong> <span class="text-success"><strong>Exames já analisados</strong></span>;
			<span class="text-danger"><strong>Exames ainda não analisados</strong></span>
		</p>
		<!-- Listagem de exames marcados (**todos para um veterinário**) com os campos: data de solicitação (**link para consulta**), Cliente, Animal, Espécie, Tipo de Animal, nome do exame, objetivo, analisado (colorir)!-->
		<div class="spinner">
			<img src="/img/spinner.gif">
			<p>Aguarde...</p>
		</div>
		<table class="table table-bordered tabela_exames_interno">
			<thead>
				<tr class="bg-info">
					<th>Data</th>
					<th>Exame</th>
					<th>Objetivo</th>
					<th class="bg-primary"></th>
					<th class="bg-primary"></th>
				</tr>
			</thead>
			<tbody>
			@foreach($exames as $exame)
				<tr>
					<td>{{convertDateToBrazilian($exame->data_consulta)}}</td>
					<td>{{$exame->nome}}</td>
					<td>{{$exame->objetivo}}</td>
					<td class="text-center exame_realizado_coluna">
						<a href="#" class="exame_realizado">
							<i class="fa fa-check fa-2x" aria-hidden="true"></i>
						</a>
					</td>
					<td class="text-center">
						<a href="#" class="exclui_exame">
							<i class="fa fa-trash fa-2x" aria-hidden="true"></i>
						</a>
					</td>
					<input type="hidden" class="exame_id" value="{{$exame->id}}">
					<input type="hidden" class="analisado" value="{{$exame->analisado}}">
				</tr>
			@endforeach
			</tbody>
		</table>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#novoExame">Novo Exame</button>
	</fieldset>
	@endif
	<!-- Modal -->
	<div id="novoExame" class="modal fade" role="dialog">
    	<div class="modal-dialog">
	        <!-- Modal content-->
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	                <h4 class="modal-title">Marcar Novo Exame</h4>
	             </div>
             	<form action="{{action('ExameController@adiciona')}}" method="POST">
             		<input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
		            <div class="modal-body">
		                <p>
		                	Preencha os campos abaixo caso deseje marcar um novo exame para o animal que está passando pela consulta.
		                </p>
		                
		                	<div class="row">
		                		<div class="col-md-6">
		                			<div class="form-group">
		                				<label for="nome">Nome do Exame</label>
		                				<input type="text" name="nome" id="nome_exame" class="form-control">
		                			</div>
		                		</div>
		                		<div class="col-md-6">
		                			<div class="form-group">
		                				<label for="objetivo">Objetivo</label>
		                				<input type="text" name="objetivo" id="objetivo_exame" class="form-control">
		                			</div>
		                		</div>
		                	</div>
		             </div>
		            <div class="modal-footer">
		            	<button type="button" class="btn btn-primary" id="marcar_exame">Marcar Exame</button>
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		            </div>
	            </form>
	    	</div>
		</div>
	</div>
@stop
