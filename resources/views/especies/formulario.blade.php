@extends("layout/template")
@section("titulo")
	ClínicaVeterinária | Espécie
@stop
@section("conteudo")
	<h1>Adicionar Nova Espécie</h1>
	<p>Selecione o tipo de animal à qual a espécie pertence e digite o nome da nova espécie</p>
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
	<form action="{{action('EspecieController@adiciona')}}" method="POST">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="tipoAnimal_id">Tipo de Animal</label>
					<select name="tipoAnimal_id" class="form-control" id="tipoAnimal_id">
						<option value="">Selecione</option>
						@foreach($tipo_animais as $tipo)
							<option value="{{$tipo->id}}">{{$tipo->descricao}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="nome">Espécie</label>
					<input type="text" id="especie_nome" name="nome" class="form-control" value="{{old('nome')}}">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="descricao">Descrição</label>
					<textarea name="descricao" class="form-control" rows="4">{{old('descricao')}}</textarea>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Salvar</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
@stop