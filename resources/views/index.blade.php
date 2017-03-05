@extends("layout/template")
@section("titulo")
	Clínica Veterinária | Home
@stop
@section("conteudo")
	<h1>Dashboard</h1>
	<!-- Dashboard para o veterinário !-->
	@if($tipo_usuario == "VET")
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-user-md fa-5x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="destaquePainel">{{sprintf("%02d",$qtdConsultasRealizadas)}}</div>
								<div>Tratamentos Finalizados</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel">
									<a href="{{action('HistoricoConsultaController@lista')}}">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconePrimary">
									<a href="{{action('HistoricoConsultaController@lista')}}">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-user-md fa-5x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="destaquePainel">{{sprintf("%02d",$qtdConsultasPendentes)}}</div>
								<div>Tratamentos Pendentes</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel iconeGreen">
									<a href="{{action('HistoricoConsultaController@lista')}}">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconeGreen">
									<a href="{{action('HistoricoConsultaController@lista')}}">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-file-text-o fa-5x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="destaquePainel">{{sprintf("%02d",$qtdExamesPendentes)}}</div>
								<div>Exames não analisados</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel iconeYellow">
									<a href="{{action('ExameController@lista')}}">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconeYellow">
									<a href="{{action('ExameController@lista')}}">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-credit-card fa-5x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="destaquePainel">{{sprintf("%02d",count($pagamentos))}}</div>
								<div>Pagamentos Pendentes</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel iconeRed">
									<a href="{{action('PagamentoController@lista')}}">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconeRed">
									<a href="{{action('PagamentoController@lista')}}">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	@endif
	@if(isset($consultas_realizadas[0]->id))
		<h3>Consultas Médicas Realizadas</h3>
		<p>
			Resumo de consultas médicas realizadas.<br>
			Legenda:
			<strong class="text-success">O tratamento foi encerrado</strong>;
			<strong class="text-danger">O tratamento ainda está em andamento, ou seja, não foi encerrado</strong>
		</p>
		<table class="table table-bordered tabela-consultas-realizadas">
			<thead>
				<tr class="bg-info">
					<th class="bg-info">Data</th>
					<th>Cliente</th>
					<th>Animal</th>
					<th>Espécie</th>
					<th>Tipo de Animal</th>
					<th>Sintomas</th>
					<th>Diagnóstico</th>
					<th>Tratamento</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($consultas_realizadas as $consulta)
				<tr>
					<td>{{convertDateToBrazilian($consulta->data)}}</td>
					<td><?=substr($consulta->cliente_nome,0,20)?></td>
					<td>{{$consulta->animal_nome}}</td>
					<td>{{$consulta->especie_nome}}</td>
					<td>{{$consulta->tipo_animal}}</td>
					<td>{{substr($consulta->sintomas,0,20)}}</td>
					<td>{{$consulta->diagnostico}}</td>
					<td>{{substr($consulta->tratamento,0,140)}}</td>
					<td>
						<form action="/historicoConsulta/consulta" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="consulta_id" value="{{$consulta->id}}">
							<input type="hidden" name="animal_id" value="{{$consulta->animal_id}}">
							<button type="submit" class="fa fa-pencil fa-2x btn btn-link icone" name="btn_atualizar"></button>
						</form>
					</td>
					<input type="hidden" class="tratamento_encerrado" value="{{$consulta->tratamento_encerrado}}">
				</tr>
				@endforeach
			</tbody>
		</table>
	@endif
	@if(isset($exames[0]->id))
		<h3>Exames Marcados</h3>
		<p>
			Listagem de exames marcados durante uma consulta médica.
			<br>
			<strong>Legenda:</strong> <span class="text-success"><strong>Exames já analisados</strong></span>;
			<span class="text-danger"><strong>Exames ainda não analisados</strong></span>
		</p>
		<div class="spinner">
			<img src="/img/spinner.gif">
			<p>Aguarde...</p>
		</div>
		<table class="table table-bordered tabela_exames_interno">
			<thead>
				<tr class="bg-info">
					<th>Data</th>
					<th>Cliente</th>
					<th>Animal</th>
					<th>Espécie</th>
					<th>Tipo de Animal</th>
					<th>Nome do Exame</th>
					<th>Objetivo do Exame</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach($exames as $exame)
				<tr>
					<td>{{convertDateToBrazilian($exame->data_consulta)}}</td>
					<td>{{$exame->cliente_nome}}</td>
					<td>{{$exame->animal_nome}}</td>
					<td>{{$exame->especie_nome}}</td>
					<td>{{$exame->tipo_animal}}</td>
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
		<input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
	@endif
	@if(isset($pagamentos[0]->id))
		<h3>Pagamentos Pendentes</h3>
		<p>Os pagamentos abaixo estão com o status <strong>Não pagos</strong></p>
		<div class="spinner">
			<img src="/img/spinner.gif">
			<p>Aguarde...</p>
		</div>
		<table class="table table-bordered tabela-pagamentos">
			<thead>
				<tr class="bg-info">
					<th>Data</th>
					<th>Valor (R$)</th>
					<th>Cliente</th>
					<th>Animal</th>
					<th>Sintomas</th>
					<th>Diagnóstico</th>
					<th>Tratamento</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach($pagamentos as $pagamento)
				<tr>
					<td>{{convertDateToBrazilian($pagamento->data)}}</td>
					<td class="dinheiro text-center">{{$pagamento->valor}}</td>
					<td>{{$pagamento->cliente_nome}}</td>
					<td>{{$pagamento->animal_nome}}</td>
					<td>{{substr($pagamento->sintomas,0,30)}}</td>
					<td>{{$pagamento->diagnostico}}</td>
					<td>{{substr($pagamento->tratamento,0,41)}}</td>
					<td>
						<a href="#" class="pagamento_realizado">
							<i class="fa fa-check fa-2x" aria-hidden="true"></i>
						</a>
					</td>
					<input type="hidden" name="pagamento_id" class="pagamento_id" value="{{$pagamento->id}}">
					<input type="hidden" name="status" class="status_pagto" value="{{$pagamento->status}}">
				</tr>
			@endforeach
				<tr class="bg-primary">
					<td colspan="8">
						Total à receber: <span class="total_receber">R$ 000.000.000,00</span>; referente à 
						<span class="quantidade_receber">00</span> consultas médicas
					</td>
				</tr>
			</tbody>
		</table>
	@endif
	<!-- Fim do Dashboard para o veterinário !-->
	<!-- Dashboard para o Secretário !-->
	@if($tipo_usuario == "SEC")
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-book fa-5x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="destaquePainel">{{sprintf("%02d",count($consultas_medicas))}}</div>
								<div>Consultas Marcadas</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel">
									<a href="{{action('ConsultaMedicaController@lista')}}">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconePrimary">
									<a href="{{action('ConsultaMedicaController@lista')}}">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-book fa-5x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="destaquePainel">{{sprintf("%02d",$proximasConsultas)}}</div>
								<div>Consultas para amanhã</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel iconeGreen">
									<a href="{{action('ConsultaMedicaController@lista')}}">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconeGreen">
									<a href="{{action('ConsultaMedicaController@lista')}}">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-user-md fa-5x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="destaquePainel">{{sprintf("%02d",count($veterinarios))}}</div>
								<div>Veterinários na clínica</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel iconeYellow">
									<a href="{{action('VeterinarioController@lista')}}">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconeYellow">
									<a href="{{action('VeterinarioController@lista')}}">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-user fa-5x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="destaquePainel">{{sprintf("%02d",$qtdClientes)}}</div>
								<div>Clientes Registrados</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel iconeRed">
									<a href="{{action('ClienteController@lista')}}">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconeRed">
									<a href="{{action('ClienteController@lista')}}">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
	@if(isset($consultas_medicas[0]->id))
		<h3>Consultas Marcadas</h3>
		<p>Consultas médicas a serem realizadas nos próximos dias</p>
		<table class="table table-bordered tabela-consulta-medica">
			<thead>
				<tr class="bg-info">
					<th>Data</th>
					<th>Horário</th>
					<th>Dias</th>
					<th>Motivo</th>
					<th>Veterinário</th>
					<th>Observação</th>
					<th>Animal</th>
					<th>Espécie do Animal</th>
					<!-- <th class="bg-warning">Tipo do Animal</th> -->
					<th>CPF</th>
					<th>Cliente</th>
					<th>Telefones</th>
					<th class="bg-primary"></th>
					<th class="bg-primary"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($consultas_medicas as $consulta)
				<tr class="text-center">
					<td>{{convertDateToBrazilian($consulta->data)}}</td>
					<td>{{substr($consulta->horario,0,5)}}</td>
					<td class="dias-restantes-consulta">{{$consulta->dias_restantes}}</td>
					<td>{{$consulta->motivo_descricao}}</td>
					<td>
						<a href="/veterinario/consulta/{{$consulta->veterinario_id}}">{{substr($consulta->veterinario_nome,0,21)}}</a>
					</td>
					<td>{{$consulta->observacao!=""?$consulta->observacao:"Não Informado"}}</td>
					<td>{{$consulta->animal_nome}}</td>
					<td><a href="/especie/{{$consulta->especie_id}}">{{substr($consulta->especie_nome,0,11)}} ({{$consulta->tipo_animal_descricao}})</a></td>
					<!-- <td>{{$consulta->tipo_animal_descricao}}</td> -->
					<td class="documento">{{$consulta->cliente_cpf}}</td>
					<td><a href="/cliente/{{$consulta->cliente_id}}">{{substr($consulta->cliente_nome,0,21)}}</a></td>
					<td>
						<span class="fone">{{$consulta->telefone}}</span>; <span class="celular">{{$consulta->celular}}</span>
					</td>
					<td>
						<form action="/consultaMedica/consulta" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="consulta_id" value="{{$consulta->id}}">
							<input type="hidden" name="animal_id" value="{{$consulta->animal_id}}">
							<button type="submit" class="fa fa-pencil fa-2x btn btn-link icone" name="btn_atualizar"></button>
						</form>
					</td>
					<td>
						<form action="/consultaMedica/apaga" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="consulta_id" value="{{$consulta->id}}">
							<button type="submit" class="fa fa-trash fa-2x btn btn-link icone" name="btn_excluir"></button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
	</table>
	@endif
	@if(isset($veterinarios[0]->id))
		<h3>Veterinários que Atendem na Clínica</h3>
		<table class="table table-bordered tabela-veterinario">
			<thead>
				<tr  class="bg-info">
					<th>Nome</th>
					<th>Especialidade</th>
					<th>CRMV</th>
					<th>E-mail</th>
					<th>Telefone</th>
					<th>Celular</th>
					<th>Horário Inicial</th>
					<th>Horário Final</th>
					<th class="bg-primary"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($veterinarios as $veterinario)
					<tr>
						<td><a href="/veterinario/consulta/{{$veterinario->id}}">{{$veterinario->nome}}</a></td>
						<td>{{substr($veterinario->especialidade_descricao,0,15)}}</td>
						<td class="documento">{{$veterinario->crmv}}</td>
						<td>{{$veterinario->email}}</td>
						<td class="fone">{{$veterinario->telefone}}</td>
						<td class="fone">{{$veterinario->celular}}</td>
						<td class="horario">{{$veterinario->horaEntrada}}</td>
						<td class="horario">{{$veterinario->horaSaida}}</td>
						<td>
							<form action="/veterinario/apaga" method="POST">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="veterinario_id" value="{{$veterinario->id}}">
								<button type="submit" class="fa fa-trash fa-2x btn btn-link" name="btn_excluir"></button>
							</form>
						</td>
					</tr>
				@endforeach
		</tbody>
</table>
	@endif
	<!-- Fim do Dashboard para o Secretário !-->
	@if(Session::has('msgAutorizacao'))
		<div class="alert alert-danger">
			{{Session::get('msgAutorizacao')}}
		</div>
	@endif
@stop