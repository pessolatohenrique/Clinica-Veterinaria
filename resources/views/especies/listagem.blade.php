@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Espécies
@stop
@section("conteudo")
	<h1>Espécies Cadastradas</h1>
	<p>
		Selecione, entre as opções, o tipo de animal desejado. Após a listagem de espécies, clique sobre a espécie para conhecer mais informações sobre esta, no ícone de <strong>lápis</strong> para editar/atualizar ou no ícone da 
		<strong>lixeira</strong> para excluir
	</p>
	@if(old("nome"))
		<div class="alert alert-success">
			Espécie <strong>{{old("nome")}}</strong> cadastrada com sucesso!
		</div>
	@endif
	@if(Session::has('msgExcluido'))
		<div class="alert alert-success">
			{{Session::get('msgExcluido')}}
		</div>
	@endif
	<form id="listaEspecie" action="{{action('EspecieController@lista')}}" method="POST">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="tipo_id">Tipo de Animal</label>
					<select name="tipo_animal" id="tipo_animal_listagem" class="form-control">
						<option value="">Selecione</option>
						@foreach($tipo_animais as $tipo)
							<option value="{{$tipo->id}}">{{$tipo->descricao}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</form>
	@if(count($especies) > 0)
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Espécie</th>
					<th>Descrição</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($especies as $esp)
					<tr>
						<td><a href="/especie/{{$esp->id}}">{{$esp->nome}}</a></td>
						<td><?=$esp->descricao!=""?substr($esp->descricao, 0,140)."(...)":"Descrição não preenchida";?></td>
						<td>
							<form action="/especie/consultaForm" method="POST">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="especie_id" value="{{$esp->id}}">
								<button type="submit" class="fa fa-pencil fa-2x btn btn-link" name="btn_excluir"></button>
							</form>
						</td>
						<td>
							<form action="/especie/apaga" method="POST">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="especie_id" value="{{$esp->id}}">
								<button type="submit" class="fa fa-trash fa-2x btn btn-link" name="btn_excluir"></button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
@stop