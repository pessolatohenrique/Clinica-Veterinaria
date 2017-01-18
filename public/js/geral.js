/*cria mecanismo de autocomplete do jQuery UI, adaptável para campos e vetores*/
function setAutoComplete(campo_id,vetor){
	console.log(vetor);
	$("#"+campo_id).autocomplete({
		source: vetor
	});
}
/*lista as espécies e retorna em formato JSON*/
function listaEspecies(tipo_id){
	$.ajax({
		url: "/especie/json",
		dataType: "json",
		method: "GET",
		data: {"tipoAnimal_id":tipo_id},
		success: function(data){
			var vetEspecies = [];
			$.each(data,function(indice,valor){
				vetEspecies.push(valor.nome);
			});
			setAutoComplete("especie_nome",vetEspecies);
		},error:function(){
			alert("Erro ao listar espécies. Contate o desenvolvedor");
		}

	});
}
/*lista as espécies de acordo com um tipo de animal em formato JSON, para combobox*/
function listaEspeciesCombo(tipo_id){
	//tipo_id funcionando
	$.ajax({
		url: "/especie/json",
		dataType: "json",
		method: "GET",
		data: {"tipoAnimal_id":tipo_id},
		success: function(data){
			var vetEspecies = new Array();
			$.each(data,function(indice,valor){
				vetEspecies[indice] = valor.id + "-" + valor.nome;
			});
			preencheComboEspecies(vetEspecies);
		},error:function(){
			alert("Erro ao listar espécies. Contate o desenvolvedor");
		}
	});
}
/*preenche a combo de espécies*/
function preencheComboEspecies(vetor){
	$("#animal_especie option").remove();
	$("#animal_especie").append($("<option></option>").attr("value","").text("Selecione"));
	$.each(vetor,function(indice,valor){
		var split = valor.split("-");
		$("#animal_especie").append($("<option></option>").attr("value",split[0]).text(split[1]));
	});
}
/*adiciona um animal via requisição AJAX*/
function adicionaAnimal(vetor){
	$.ajax({
		url: "/animal/adiciona",
		method: "POST",
		data: {"_token":vetor["_token"],"cliente_id":vetor["cliente_id"],"especie_id":vetor["especie_id"],
		"nome":vetor["nome"],"peso":vetor["peso"],"altura":vetor["altura"]},
		success: function(data){
			console.log(data);
			adicionaTabelaAnimal(vetor);
		},error: function(){
			alert("Erro ao adicionar animal a este cliente. Contate o desenvolvedor");
		}
	});
}
/*adiciona uma nova linha à tabela Animal, com os dados do Animal adicionado*/
function adicionaTabelaAnimal(vetor){
	var coluna = "<tr class='bg-success'>";
	coluna = coluna + "<td>"+vetor["nome"]+"</td>";
	coluna = coluna + "<td>"+vetor["tipo_animal"]+"</td>";
	coluna = coluna + "<td>"+vetor["especie_nome"]+"</td>";
	coluna = coluna + "<td>"+vetor["peso"]+"</td>";
	coluna = coluna + "<td>"+vetor["altura"]+"</td>";
	coluna = coluna + "<td></td>";
	coluna = coluna + "</tr>";
	$(".tabela-animal").append(coluna);
}
$(document).ready(function(){
	$(".fone").mask("(00) 0000-0000");
	$(".celular").mask("(00) 00000-0000");
	$(".documento").mask("000.000.000-00");
	$(".rg").mask("00.000.000-0");
	$(".data").mask("00/00/0000");
	$(".horario").mask("00:00");
	$("#tipoAnimal_id").on("change",function(event){
		var tipo_id = $(this).val();
		listaEspecies(tipo_id);
	});
	$("#tipo_animal_listagem").on("change",function(event){
		document.getElementById("listaEspecie").submit();
	});
	$("#animal_tipo").on("change",function(event){
		var tipo_id = $(this).val();
		listaEspeciesCombo(tipo_id);
	});
	$("#adiciona_animal").on("click",function(event){
		var vetor_animal = Array();
		vetor_animal["_token"] = $("#token").val();
		vetor_animal["cliente_id"] = $("#cliente_id").val();
		vetor_animal["especie_id"] = $("#animal_especie").val();
		vetor_animal["especie_nome"] = $("#animal_especie option:selected").text();
		vetor_animal["tipo_animal"] = $("#animal_tipo option:selected").text();
		vetor_animal["nome"] = $("#animal_nome").val();
		vetor_animal["peso"] = $("#animal_peso").val();
		vetor_animal["altura"] = $("#animal_altura").val();
		adicionaAnimal(vetor_animal);
		$('#adicionaAnimal').modal('toggle');
	});
});