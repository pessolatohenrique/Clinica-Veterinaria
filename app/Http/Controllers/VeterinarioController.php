<?php namespace ClinicaVeterinaria\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Request;
class VeterinarioController extends Controller {
	public function lista(){
		$veterinarios = DB::select("SELECT v.*,e.nome AS especialidade_descricao 
			FROM veterinarios v INNER JOIN especialidades e ON v.especialidade_id = e.id 
			ORDER BY v.nome");
		$dados = array("veterinarios" => $veterinarios);
		return view("veterinario/listagem")->with($dados);
	}
	public function consulta($veterinario_id){
		$veterinario = DB::select("SELECT v.*,e.nome AS especialidade_descricao 
			FROM veterinarios v INNER JOIN especialidades e ON v.especialidade_id = e.id 
			WHERE v.id = ?",[$veterinario_id]);
		$dados = array("veterinario" => $veterinario);
		return view("veterinario/consulta")->with($dados);
	}
}