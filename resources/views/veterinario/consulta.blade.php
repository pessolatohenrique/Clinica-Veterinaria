@extends("layout/template")
@section("titulo")
	Veterinário | {{$veterinario[0]->nome}}
@stop
@section("conteudo")
<h1>{{$veterinario[0]->nome}} (Veterinário)</h1>
<p>
	<strong>CRMV: </strong><span class="documento">{{$veterinario[0]->crmv}}</span><br>
	<strong>CPF: </strong><span class="documento">{{$veterinario[0]->cpf}}</span><br>
	<strong>Especialidade: </strong>{{$veterinario[0]->especialidade_descricao}}<br>
	<strong>E-mail: </strong>{{$veterinario[0]->email}}<br>
	<strong>Telefone: </strong><span class="fone">{{$veterinario[0]->telefone}}</span><br>
	<strong>Celular: </strong><span class="fone">{{$veterinario[0]->celular}}</span><br>
	<strong>Contrado em: </strong>{{convertDateToBrazilian($veterinario[0]->dataAdmissao)}}<br>
	<strong>Horário de Entrada: </strong><span class="horario">{{$veterinario[0]->horaEntrada}}</span><br>
	<strong>Horário de Saída: </strong><span class="horario">{{$veterinario[0]->horaSaida}}</span>
</p>
@stop