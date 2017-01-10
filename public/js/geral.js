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
$(document).ready(function(){
	$(".fone").mask("(00) 0000-0000");
	$(".celular").mask("(00) 00000-0000");
	$(".documento").mask("000.000.000-00");
	$(".data").mask("00/00/0000");
	$(".horario").mask("00:00");
	$("#tipoAnimal_id").on("change",function(event){
		var tipo_id = $(this).val();
		listaEspecies(tipo_id);
	});
	$("#tipo_animal_listagem").on("change",function(event){
		document.getElementById("listaEspecie").submit();
	});
});