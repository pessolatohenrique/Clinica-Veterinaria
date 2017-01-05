<?php
function convertDateToBrazilian($data){
	$split = explode("-",$data);
	return $split[2]."/".$split[1]."/".$split[0];
}
function convertDateToAmerican($data){
	$split = explode("/",$data);
	return $split[2]."-".$split[1]."-".$split[0];
}