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
		if(isset($params["data_inicial"]) && $params["data_inicial"] != ""){
			$dataInicio = convertDateToAmerican($params["data_inicial"]);
			$query = $query." AND cv.data >= '{$dataInicio}'";
		}
		if(isset($params["data_final"]) && $params["data_final"] != ""){
			$dataFim = convertDateToAmerican($params["data_final"]);
			$query = $query." AND cv.data <= '{$dataFim}'";
		}
		if(isset($params["cpf"]) && $params["cpf"] != ""){
			$cpf = documentToDataBase($params["cpf"]);
			$query = $query." AND c.cpf = '{$cpf}'";
		}
		if(isset($params["cliente"]) && $params["cliente"] != ""){
			$cliente = $params["cliente"];
			$query = $query." AND c.nome LIKE '%{$cliente}%'";
		}
		if(isset($params["exame"]) && $params["exame"] != ""){
			$exame = $params["exame"];
			$query = $query." AND ex.nome LIKE '%{$exame}%'";
		}
		if(isset($params["objetivo"]) && $params["objetivo"] != ""){
			$objetivo = $params["objetivo"];
			$query = $query." AND ex.objetivo LIKE '%{$objetivo}%'";
		}
		if(isset($params["analisado"]) && $params["analisado"] != ""){
			$analisado = $params["analisado"];
			$query = $query." AND ex.analisado = {$analisado}";
		}
		$query = $query." ORDER BY cv.data DESC";
		return DB::select($query);
	}
	public function atualiza($exame_id,$campos){
		return DB::table("exames")->where("id",$exame_id)->update($campos);
	}
	public function exclui($exame_id){
		return DB::table("exames")->where("id",$exame_id)->delete();
	}
}