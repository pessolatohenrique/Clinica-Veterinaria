/*modifica a aparência da linha, tal como cor e ícone, de acordo com o status do pagamento*/
function modificaLinha(status,linha){
	if(status == 1){
		$(linha).removeClass("bg-danger");
		$(linha).addClass("bg-success");
		$(linha).find(".pagamento_realizado i").removeClass("fa-check");
		$(linha).find(".pagamento_realizado i").addClass("fa-times");
		$(linha).find(".status_pagto").val("1");
	}else{
		$(linha).removeClass("bg-success");
		$(linha).addClass("bg-danger");
		$(linha).find(".pagamento_realizado i").removeClass("fa-times");
		$(linha).find(".pagamento_realizado i").addClass("fa-check");
		$(linha).find(".status_pagto").val("0");
	}
}
/*atualiza o status de um pagamento para pago ou não pago, de acordo com o seu ID e status*/
function atualizaStatusPagto(pagamento_id,status,linha){
	$(".spinner").addClass("mostra-spinner");
	var token = $("#token").val();
	var novo_status = 0;
	status==1?novo_status=0:novo_status=1;
	var dados = {"_token":token,"pagamento_id":pagamento_id,"status":novo_status};
	$.post("pagamento/atualiza",dados,function(data){
		modificaLinha(novo_status,linha);
	})
	.fail(function(){
		alert("Erro ao alterar o pagamento. Contate o desenvolvedor!");
	})
	.always(function(){
		$(".spinner").removeClass("mostra-spinner");
	});
}
/*procura o ID do pagamento clicado*/
function buscaIdPagto(event){
	event.preventDefault();
	var linha = $(this).parent().parent();
	var pagamento_id = linha.find(".pagamento_id").val();
	var status = linha.find(".status_pagto").val();
	atualizaStatusPagto(pagamento_id,status,linha);
}
/*verifica, em uma tabela, quais pagamentos foram realizados ou não*/
function verificaStatusPagto(tabela){
	var linhas = tabela.find("tr");
	var status = 0;
	$.each(linhas,function(key,val){
		status = $(val).find(".status_pagto").val();
		modificaLinha(status,val);
		$(val).find(".pagamento_realizado").on("click",buscaIdPagto);
	});
}
$(document).ready(function(){
	var temClasse = $("table").hasClass("tabela-pagamentos");
	if(temClasse){
		var tabela = $(".tabela-pagamentos").find("tbody");
		verificaStatusPagto(tabela);
	}
});