function verificaStatusTratamento(linhas){
	$.each(linhas,function(key,val){
		var encerrou = $(val).find(".tratamento_encerrado").val();
		if(encerrou == 1){
			$(val).addClass("bg-success");
		}else{
			$(val).addClass("bg-danger");
		}
	});
}
$(document).ready(function(){
	var classeExiste = $("table").hasClass("tabela-consultas-realizadas");
	if(classeExiste){
		var linhas = $(".tabela-consultas-realizadas").find("tbody").find("tr");
		verificaStatusTratamento(linhas);
	}
});