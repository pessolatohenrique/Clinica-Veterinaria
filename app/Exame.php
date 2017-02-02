<?php namespace ClinicaVeterinaria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Exame extends Model {
	public $timestamps = false;
	protected $fillable = ["consulta_id","nome","objetivo","analisado"];
	public function lista($veterinario_id,$params = array()){
		$query = "SELECT ex.id, cv.data AS data_consulta, c.id AS cliente_id, c.nome AS cliente_nome, a.id AS animal_id, a.nome AS animal_nome, e.id AS especie_id, e.nome AS especie_nome, t.descricao AS tipo_animal, ex.nome, ex.objetivo, ex.analisado FROM consultas_veterinario cv 
			INNER JOIN exames ex ON ex.consulta_id = cv.id
			INNER JOIN animais a ON cv.animal_id = a.id
			INNER JOIN clientes c ON a.cliente_id = c.id
			INNER JOIN especies e ON a.especie_id = e.id
			INNER JOIN tipo_animais t ON e.tipoAnimal_id = t.id
			WHERE cv.veterinario_id = {$veterinario_id}";
		if(isset($params["animal_id"]) && $params["animal_id"] != ""){
			$animal_id = $params["animal_id"];
			$query = $query." AND cv.animal_id = {$animal_id}";
		}
		$query = $query." ORDER BY cv.data DESC";
		return DB::select($query);
	}
	public function atualiza($exame_id,$campos){
		return DB::table("exames")->where("id",$exame_id)->update($campos);
	}
}