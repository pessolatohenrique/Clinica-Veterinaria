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
	<h1>{{isset($cliente->id)?"Alterar Cliente - $cliente->nome":"Cadastrar Cliente"}}</h1>
	@if(Session::has('msgExcluido'))
		<div class="alert alert-success">
			{{Session::get('msgExcluido')}}
		</div>
	@endif
	<form action="{{isset($cliente->id)?'/cliente/atualiza':'cliente/adiciona'}}" method="POST">
		<input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
		<input type="hidden" id="cliente_id" name="cliente_id" value="{{isset($cliente->id)?$cliente->cliente_id:''}}">
		<fieldset>
			<legend>Dados Pessoais</legend>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label for="cpf">CPF</label>
						<input type="text" name="cpf" id="cpf" class="form-control documento"
						value="{{isset($cliente->id)?$cliente->cpf:old('cpf')}}">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="rg">RG</label>
						<input type="text" name="rg" id="rg" class="form-control rg"
						value="{{isset($cliente->id)?$cliente->rg:old('rg')}}">
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" name="nome" id="nome" class="form-control"
						value="{{isset($cliente->id)?$cliente->nome:old('nome')}}">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="telefone">Telefone</label>
					<input type="text" name="telefone" id="telefone" class="form-control fone"
					value="{{isset($cliente->id)?$cliente->telefone:old('telefone')}}">
				</div>
				<div class="col-md-2">
					<label for="celular">Celular</label>
					<input type="text" name="celular" id="celular" class="form-control celular"
					value="{{isset($cliente->id)?$cliente->celular:old('celular')}}">
				</div>
				<div class="col-md-8">
					<label for="email">E-mail</label>
					<input type="email" name="email" id="email" class="form-control"
					value="{{isset($cliente->id)?$cliente->email:old('email')}}">
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
						value="{{isset($cliente->id)?$cliente->cep:old('cep')}}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="logradouro">Logradouro</label>
						<input type="text" name="logradouro" id="logradouro_formulario" class="form-control"
						value="{{isset($cliente->id)?$cliente->logradouro:old('logradouro')}}"> 
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="numero">Número</label>
						<input type="number" name="numero" id="numero_formulario" class="form-control"
						value="{{isset($cliente->id)?$cliente->numero:old('numero')}}">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="complemento">Complemento</label>
						<input type="text" name="complemento" id="complemento_formulario" class="form-control"
						value="{{isset($cliente->id)?$cliente->complemento:old('complemento')}}">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="bairro">Bairro</label>
						<input type="text" name="bairro" id="bairro_formulario" class="form-control"
						value="{{isset($cliente->id)?$cliente->bairro:old('bairro')}}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="cidade">Cidade</label>
						<input type="text" name="cidade" id="cidade_formulario" class="form-control"
						value="{{isset($cliente->id)?$cliente->cidade:old('cidade')}}">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="estado">Estado</label>
						<input type="text" name="estado" id="estado_formulario" class="form-control" maxlength="2"
						value="{{isset($cliente->id)?$cliente->estado:old('estado')}}">
					</div>
				</div>
			</div>
		</fieldset>
		<button type="submit" class="btn btn-primary">Salvar</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
	@if(isset($cliente->id))
	<fieldset style="margin-top:1em">
		<legend>Animais que o cliente possui</legend>
		@if(count($animais) > 0)
			<table class="table table-bordered tabela-animal">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Tipo de Animal</th>
						<th>Espécie</th>
						<th>Peso(KG)</th>
						<th>Altura(cm)</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($animais as $animal)
						<tr>
							<td>{{$animal->nome}}</td>
							<td>{{$animal->tipo_descricao}}</td>
							<td><a href="/especie/{{$animal->especie_id}}">{{$animal->especie_nome}}</a></td>
							<td>{{$animal->peso}}</td>
							<td>{{$animal->altura}}</td>
							<td>
								<form action="/animal/apaga" method="POST">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="cliente_id" value="{{$cliente->id}}">
									<input type="hidden" name="animal_id" value="{{$animal->id}}">
									<button type="submit" class="fa fa-trash fa-2x btn btn-link icone" name="btn_excluir">
									</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<div class="alert alert-info">
				Nenhum animal cadastrado para este cliente!
			</div>
		@endif
	</fieldset>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#adicionaAnimal">
		Adicionar Animal
	</button>
	@endif
	<!-- Modal/Dialog que permite adicionar um animal -->
	<div id="adicionaAnimal" class="modal fade" role="dialog">
		<div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
	      		<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Adicionar Animal</h4>
		      	</div>
		      	<div class="modal-body">
		      		@if(isset($cliente->id))
		        	<p>
		        		Utilize o formulário abaixo para adicionar um Animal ao Cliente <strong>{{$cliente->nome}}</strong>.
		        	</p>
		        	@endif
		        	<form>
		        		<div class="row">
		        			<div class="col-md-6">
		        				<div class="form-group">
		        					<label for="tipoAnimal_id">Tipo de Animal</label>
		        					<select name="tipoAnimal_id" id="animal_tipo" class="form-control">
		        						<option value="">Selecione</option>
		        						@if(isset($tipos_animais))
		        						@foreach($tipos_animais as $tipo)
		        							<option value="{{$tipo->id}}">{{$tipo->descricao}}</option>
		        						@endforeach
		        						@endif
		        					</select>
		        				</div>
		        			</div>
		        			<div class="col-md-6">
		        				<div class="form-group">
		        					<label for="animal_especie">Espécie</label>
		        					<select name="especie_id" id="animal_especie" class="form-control">
		        						<option value="">Selecione</option>
		        					</select>
		        				</div>
		        			</div>
		        		</div>
		        		<div class="row">
		        			<div class="col-md-8">
		        				<div class="form-group">
		        					<label for="nome">Nome</label>
		        					<input type="text" name="nome" id="animal_nome" class="form-control">
		        				</div>
		        			</div>
		        			<div class="col-md-2">
		        				<div class="form-group">
		        					<label for="nome">Peso</label>
		        					<input type="text" name="peso" id="animal_peso" class="form-control">
		        				</div>
		        			</div>
		        			<div class="col-md-2">
		        				<div class="form-group">
		        					<label for="nome">Altura</label>
		        					<input type="text" name="altura" id="animal_altura" class="form-control">
		        				</div>
		        			</div>
		        		</div>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		      		<button type="button" class="btn btn-primary" id="adiciona_animal">Salvar</button>
		        	<button type="button" class="btn btn-warning" data-dismiss="modal">Fechar</button>
		      	</div>
		    </div>
	  </div>
	</div>
@stop