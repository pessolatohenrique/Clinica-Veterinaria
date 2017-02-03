function limpaModal(){
	$("#marcar_exame").attr("disabled",true);
	$('#novoExame').modal('toggle');
	$("#nome_exame").val("");
	$("#objetivo_exame").val("");
}
function novaLinhaExame(objeto){
	var dataConsulta = $("#data_consulta").val();
	var tabela = $(".tabela_exames_interno");
	var linha = $("<tr>").addClass("bg-danger");
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
function alteraEstiloExame(analisado,linha){
	if(analisado == 1){
		$(linha).removeClass("bg-danger");
		$(linha).addClass("bg-success");
		$(linha).find(".exame_realizado i").removeClass("fa-check");
		$(linha).find(".exame_realizado i").addClass("fa-times");
		$(linha).find(".analisado").val("1");
	}else{
		$(linha).removeClass("bg-success");
		$(linha).addClass("bg-danger");
		$(linha).find(".exame_realizado i").removeClass("fa-times");
		$(linha).find(".exame_realizado i").addClass("fa-check");
		$(linha).find(".analisado").val("0");
	}
}
function atualizaExame(exame_id,analisado,linha){
	$(".spinner").addClass("mostra-spinner");
	var analisado_atualiza = 0;
	if(analisado == 1){
		analisado_atualiza = 0;
	}else{
		analisado_atualiza = 1;
	}
	var token = $("#token").val();
	var dados = {"_token":token,"exame_id":exame_id, "analisado":analisado_atualiza};
	$.post("/exame/atualiza",dados,function(data){
		alteraEstiloExame(dados.analisado,linha);
	})
	.fail(function(){
		alert("Erro ao atualizar exame. Contate o desenvolvedor!");
	})
	.always(function(){
		$(".spinner").removeClass("mostra-spinner");
	});
}
function buscaIdExame(event){
	event.preventDefault();
	var linha = $(this).parent().parent();
	var exame_id = linha.find(".exame_id").val();
	var foiAnalisado = linha.find(".analisado").val();
	atualizaExame(exame_id,foiAnalisado,linha);
}
function excluiExame(event){
	event.preventDefault();
	$(".spinner").addClass("mostra-spinner");
	var token = $("#token").val();
	var linha = $(this).parent().parent();
	var exame_id = linha.find(".exame_id").val();
	var dados =  {"_token":token, "exame_id":exame_id};
	$.post("/exame/apaga",dados,function(data){
		linha.fadeOut(800,function(){
			linha.remove();
		});
	})
	.fail(function(){
		alert("Erro ao excluir exame. Contate o desenvolvedor!");
	})
	.always(function(){
		$(".spinner").removeClass("mostra-spinner");
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
		$(val).find(".exame_realizado_coluna a").on("click",buscaIdExame);
		$(val).find(".exclui_exame").on("click",excluiExame);
	});
}
$(document).ready(function(){
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