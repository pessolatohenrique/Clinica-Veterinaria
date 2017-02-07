/*verifica, em uma tabela, quais pagamentos foram realizados ou não*/
function verificaStatusPagto(tabela){
	var linhas = tabela.find("tr");
	var status = 0;
	$.each(linhas,function(key,val){
		status = $(val).find(".status_pagto").val();
		if(status == 1){
			$(val).addClass("bg-success");
		}else{
			$(val).addClass("bg-danger");
		}
	});
}
$(document).ready(function(){
	var temClasse = $("table").hasClass("tabela-pagamentos");
	if(temClasse){
		var tabela = $(".tabela-pagamentos").find("tbody");
		verificaStatusPagto(tabela);
	}
});