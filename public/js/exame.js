function limpaModal(){
	$("#marcar_exame").attr("disabled",true);
	$('#novoExame').modal('toggle');
	$("#nome_exame").val("");
	$("#objetivo_exame").val("");
}
function novaLinhaExame(objeto){
	var dataConsulta = $("#data_consulta").val();
	var tabela = $(".tabela_exames_interno");
	var linha = $("<tr>").addClass("bg-info");
	var colunaData = $("<td>").text(dataConsulta);
	var colunaNome = $("<td>").text(objeto.nome);
	var colunaObjetivo = $("<td>").text(objeto.objetivo);
	var colunaRealizado = $("<td>").addClass("text-center").addClass("exame_realizado_coluna");
	var linkRealizado = $("<a>").attr("href","#").attr("id","exame_realizado");
	var iconeRealizado = $("<i>").addClass("fa").addClass("fa-check").addClass("fa-2x").attr("aria-hidden","true");
	var colunaExclui = $("<td>").addClass("text-center");
	var linkExclui = $("<a>").attr("href","#").attr("id","exclui_exame");
	var iconeExclui = $("<i>").addClass("fa").addClass("fa-trash").addClass("fa-2x").attr("aria-hidden","true");
	//adicionar na tabela
	linkRealizado.append(iconeRealizado);
	linkExclui.append(iconeExclui);
	colunaRealizado.append(linkRealizado);
	colunaExclui.append(linkExclui);
	linha.append(colunaData);
	linha.append(colunaNome);
	linha.append(colunaObjetivo);
	linha.append(colunaRealizado);
	linha.append(colunaExclui);
	tabela.append(linha);
}
function adicionaExame(objeto){
	var token = $("#token").val();
	var dados = {"_token":token, "nome":objeto.nome, "objetivo":objeto.objetivo, "consulta_id":objeto.consulta_id};
	$.post("/exame/adiciona",dados,function(data){
		novaLinhaExame(dados);
	})
	.fail(function(){
		alert("Erro ao adicionar exame. Contate o desenvolvedor!");
	})
	.always(function(){
		limpaModal();
		$("#marcar_exame").attr("disabled",false);
	});	
}
/*verifica se um exame já foi analisado*/
function verificaExames(tabela){
	var linhas = $(tabela).find("tr");
	var analisado = 0;
	$.each(linhas,function(key,val){
		analisado = $(val).find(".analisado").val();
		if(analisado == 1){
			var colunaRealizado = $(val).find(".exame_realizado_coluna");
			$(val).addClass("bg-success");
			colunaRealizado.find("i").removeClass("fa-check");
			colunaRealizado.find("i").addClass("fa-times");
		}else{
			$(val).addClass("bg-danger");
		}
	});
}
$(document).ready(function(){
	//fazer para classes da listagem geral e do formulário
	var isExame = $("table").hasClass("tabela_exames_interno");
	if(isExame){
		var tabelaExames = $(".tabela_exames_interno").find("tbody");
		verificaExames(tabelaExames);
	}
	$("#marcar_exame").on("click",function(){
		var exame = {
			"nome": $("#nome_exame").val(),
			"objetivo": $("#objetivo_exame").val(),
			"consulta_id": $("#consulta_id").val()
		};
		adicionaExame(exame);
	});
});