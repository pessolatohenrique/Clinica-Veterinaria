<?php namespace ClinicaVeterinaria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class HistoricoConsulta extends Model {
	public $timestamps = false;
	protected $table = "consultas_veterinario";
	protected $fillable = ["veterinario_id", "animal_id", "data", "sintomas", "diagnostico", "tratamento",
	"tratamento_encerrado"];
	/*listagem de consultas realizadas filtrando por veterinário*/
	public function lista($veterinario_id,$params = array()){
		$query = "SELECT cv.veterinario_id, cv.id, cv.data, c.nome AS cliente_nome ,cv.animal_id, a.nome AS animal_nome, e.nome AS especie_nome, t.descricao AS tipo_animal, cv.sintomas, cv.diagnostico, cv.tratamento, cv.tratamento_encerrado
			FROM consultas_veterinario cv
			INNER JOIN animais a ON cv.animal_id = a.id
			INNER JOIN clientes c ON a.cliente_id = c.id
			INNER JOIN especies e ON a.especie_id = e.id
			INNER JOIN tipo_animais t ON e.tipoAnimal_id = t.id
			WHERE cv.veterinario_id = 13";
		//filtragem da pesquisa
		if(isset($params["dataInicio"]) && $params["dataInicio"] != ""){
			$dataInicio = convertDateToAmerican($params["dataInicio"]);
			$query = $query." AND cv.data >= '{$dataInicio}'";
		}
		if(isset($params["dataFinal"]) && $params["dataFinal"] != ""){
			$dataFinal = convertDateToAmerican($params["dataFinal"]);
			$query = $query." AND cv.data <= '{$dataFinal}'";
		}
		if(isset($params["cpf_cliente"]) && $params["cpf_cliente"] != ""){
			$cpf = documentToDataBase($params["cpf_cliente"]);
			$query = $query." AND c.cpf = '{$cpf}'";
		}
		if(isset($params["nome_cliente"]) && $params["nome_cliente"] != ""){
			$nome = $params["nome_cliente"];
			$query = $query." AND c.nome LIKE '%{$nome}%'";
		}
		if(isset($params["sintomas"]) && $params["sintomas"] != ""){
			$sintomas = $params["sintomas"];
			$query = $query." AND cv.sintomas LIKE '%{$sintomas}%'";
		}
		if(isset($params["diagnostico"]) && $params["diagnostico"] != ""){
			$diagnostico = $params["diagnostico"];
			$query = $query." AND cv.diagnostico LIKE '%{$diagnostico}%'";
		}
		if(isset($params["tratamento"]) && $params["tratamento"] != ""){
			$tratamento = $params["tratamento"];
			$query = $query." AND cv.tratamento LIKE '%{$tratamento}%'";
		}
		if(isset($params["tratamento_encerrado"]) && $params["tratamento_encerrado"] != ""){
			$encerrado = $params["tratamento_encerrado"];
			$query = $query." AND cv.tratamento_encerrado = {$encerrado}";
		}
		$query = $query." ORDER BY cv.data DESC"; 
		return DB::select($query);
	}
	public function consulta($consulta_id){
		$query = "SELECT cv.veterinario_id, cv.id, cv.data, c.id AS cliente_id, c.cpf AS cliente_cpf, c.nome AS cliente_nome ,cv.animal_id, a.nome AS animal_nome, e.nome AS especie_nome, t.descricao AS tipo_animal, cv.sintomas, cv.diagnostico, cv.tratamento, cv.tratamento_encerrado
			FROM consultas_veterinario cv
			INNER JOIN animais a ON cv.animal_id = a.id
			INNER JOIN clientes c ON a.cliente_id = c.id
			INNER JOIN especies e ON a.especie_id = e.id
			INNER JOIN tipo_animais t ON e.tipoAnimal_id = t.id
			WHERE cv.veterinario_id = 13
			AND cv.id = {$consulta_id}";
		return DB::select($query);
	}
	public function atualiza($consulta_id,$campos){
		DB::table("consultas_veterinario")->where("id",$consulta_id)->update($campos);
	}
	public function deleta($consulta_id){
		DB::table("consultas_veterinario")->where("id",$consulta_id)->delete();
	}
	public function contaTotal($condicao,$valor){
		$totalQtd = DB::table('consultas_veterinario')->where($condicao,$valor)->count();
		return $totalQtd;
	}
}
