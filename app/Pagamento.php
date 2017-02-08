<?php namespace ClinicaVeterinaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Pagamento extends Model {
	public $timestamps = false;
	protected $table = "pagamentos";
	protected $fillable = ["consulta_id","valor","status"];
	public function lista($params = array()){
		$query = "SELECT p.id, cv.id AS consulta_id, cv.data, p.valor, c.nome AS cliente_nome, a.nome AS animal_nome, cv.sintomas, cv.diagnostico, cv.tratamento, p.status 
			FROM pagamentos p 
			INNER JOIN consultas_veterinario cv ON p.consulta_id = cv.id
			INNER JOIN animais a ON cv.animal_id = a.id
			INNER JOIN clientes c ON a.cliente_id = c.id
			WHERE p.id <> ''";
		if(isset($params["cpf"]) && $params["cpf"] != ""){
			$cpf = documentToDataBase($params["cpf"]);
			$query = $query." AND c.cpf = '{$cpf}'";
		}
		if(isset($params["cliente"]) && $params["cliente"] != ""){
			$cliente = $params["cliente"];
			$query = $query." AND c.nome LIKE '%{$cliente}%'";
		}
		if(isset($params["dataInicial"]) && $params["dataInicial"] != ""){
			$dataInicio = convertDateToAmerican($params["dataInicial"]);
			$query = $query." AND cv.data >= '{$dataInicio}'";
		}
		if(isset($params["dataFinal"]) && $params["dataFinal"] != ""){
			$dataFim = convertDateToAmerican($params["dataFinal"]);
			$query = $query." AND cv.data <= '{$dataFim}'";
		}
		if(isset($params["valor"]) && $params["valor"] != ""){
			$valor = moneyToDataBase($params["valor"]);
			$query = $query." AND p.valor >= {$valor}";
		}
		$query = $query." ORDER BY cv.data DESC";
		return DB::select($query);
	}
	public function atualiza($pagamento_id,$campos){
		DB::table("pagamentos")->where("id",$pagamento_id)->update($campos);
	}
}
