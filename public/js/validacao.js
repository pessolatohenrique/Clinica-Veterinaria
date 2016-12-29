/*Arquivo responsável por funções de validação*/
function criaDatePicker(seletor){
	$.datepicker.setDefaults($.datepicker.regional['pt-BR']);
	$("#"+seletor).datepicker({
		dateFormat: "dd/mm/yy"
	});
}
function verificaEnvio(array){
	var tamanho = array.length;
	var valido = 0;
	for(var i = 0; i < array.length; i++){
		if(array[i] == true){
			valido++;
		}
	}
	if(valido == tamanho){
		document.getElementById("formulario").submit();
	}
}
function limpaValidacao(tipo){
	$("#"+tipo).parent().find("span").remove();
	$("#"+tipo).css("border","1px solid #ccc");
}
function validaCampo(tipo,campo){
	limpaValidacao(tipo);
	campo = campo.toLowerCase();
	var valido = true;
	if(campo == "selecione" || campo == ""){
		$("#"+tipo).css("border","0.3em solid red");
		$("#"+tipo).parent().append($("<span></span>").css("color","rgb(255, 0, 0)").text("Campo Obrigatório"));
		valido = false;
	}
	return valido;
}
function validaArquivo(arquivo){
	var valido = true;
	if(arquivo == ""){
		alert("Selecione uma imagem de divulgação");
		valido = false;
	}
	return valido;
}
function quebraData(data,caracter){
	var novaData = data.split(""+caracter+"");
	return novaData;
}
function comparaDataAgenda(dataForm){
	var dataAtual = new Date();
	var dataComp = new Date();
	var mes = 0;
	var valido = true;
	dataForm = quebraData(dataForm,"/");
	mes = dataForm[1] - 1;
	dataComp.setFullYear(dataForm[2],mes,dataForm[0]);
	if(dataAtual > dataComp){
		valido = false;
	}
	return valido;
}
function validaEmail(email){
    var temArroba = email.indexOf("@");
    var temPonto = email.indexOf(".com");
    var valido = true;
    if((email.length <= 10) || (temArroba == -1) || (temPonto == -1)){
    	valido = false;
    }
    return valido;
}
function validaSenha(senha){
    var valido = true;
    if(senha.length <= 4){
    	valido = false;
    }
    return valido;
}
function comparaSenha(senhaA,senhaB){
	var valido = true;
    if(senhaA != senhaB || senhaB == ""){
    	valido =  false;
    }
    return valido;
}
function configuraMensagem(campo,mensagem){
	limpaValidacao(campo);
	$("#"+campo).css("border","0.3em solid red");
    $("#"+campo).parent().append($("<span></span>").css("color","rgb(255, 0, 0)").text(""+mensagem+""));
}
/*==Fim das funções de validação==*/