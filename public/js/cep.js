/*arquivo com funções de busca de endereço através do CEP*/
/*limpa os campos do formulário de endereço*/
function limpa_formulario(){
    $("#logradouro_formulario").val("");
    $("#bairro_formulario").val("");
    $("#cidade_formulario").val("");
    $("#estado_formulario").val("");
}
/*busca o endereço completo do CEP informado*/
function buscaCEP(cep){
	if(cep != ""){
		$.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?",function(dados){
			if(!("erro" in dados)){
			    $("#logradouro_formulario").val(dados.logradouro);
    			$("#bairro_formulario").val(dados.bairro);
    			$("#cidade_formulario").val(dados.localidade);
    			$("#estado_formulario").val(dados.uf);
			}else{
				limpa_formulário_cep();
				alert("CEP não encontrado");
			}
		});
	}else{
		limpa_formulario();
	}
}
$(document).ready(function(){
	$("#cep_formulario").on("blur",function(event){
		var cep = $(this).val();
		buscaCEP(cep);
	});
});