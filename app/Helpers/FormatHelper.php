<?php
/*formata o CPF ou o CRMV para o banco de dados*/
function documentToDataBase($documento){
	$formatado = str_replace(".","",$documento);
	$formatado = str_replace("-","",$formatado);
	return $formatado;
}
/*formata um telefone ou celular para o banco de dados*/
function phoneToDataBase($telefone){
	$formatado = str_replace("(","",$telefone);
	$formatado = str_replace(")", "",$formatado);
	$formatado = str_replace("-", "",$formatado);
	return $formatado;
}
/*formata um valor monetário em R$ para o banco de dados*/
function moneyToDataBase($valor){
	$formatado = str_replace(".","",$valor);
	$formatado = str_replace(",",".",$formatado);
	return $formatado;
}