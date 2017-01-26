<?php namespace ClinicaVeterinaria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ConsultaMedica extends Model {
	public $timestamps = false;
	protected $table = "consultas_medicas";
	protected $fillable = ["animal_id","veterinario_id","motivo_id","data","horario","observacao"];
	public function listaMotivos(){
		return DB::table("motivos_consulta")->get();
	}
	public function lista($parametros){
		$query = "SELECT cm.id,cm.data, cm.horario, DATEDIFF(cm.data,NOW()) AS dias_restantes, cm.motivo_id, m.motivo AS motivo_descricao, cm.veterinario_id, v.nome AS veterinario_nome, cm.observacao, cm.animal_id, a.nome AS animal_nome, a.especie_id, e.nome AS especie_nome, e.tipoAnimal_id, t.descricao AS tipo_animal_descricao, a.cliente_id, c.cpf AS cliente_cpf, c.nome AS cliente_nome, c.telefone, c.celular
			FROM consultas_medicas cm
			INNER JOIN motivos_consulta m ON cm.motivo_id = m.id 
			INNER JOIN veterinarios v ON cm.veterinario_id = v.id
			INNER JOIN animais a ON cm.animal_id = a.id
			INNER JOIN especies e ON a.especie_id = e.id
			INNER JOIN tipo_animais t ON e.tipoAnimal_id = t.id
			INNER JOIN clientes c ON a.cliente_id = c.id
			WHERE DATEDIFF(cm.data,NOW()) >= 0";
		/*filtragem de campos para pesquisas*/
		if(isset($parametros["dataInicial"]) && $parametros["dataInicial"] != ""){
			$dataInicial = $parametros["dataInicial"];
			$query = $query." AND cm.data >= '{$dataInicial}'";
		}
		if(isset($parametros["dataFinal"]) && $parametros["dataFinal"] != ""){
			$dataFinal = $parametros["dataFinal"];
			$query = $query." AND cm.data <= '{$dataFinal}'";
		}
		if(isset($parametros["horaInicial"]) && $parametros["horaInicial"] != ""){
			$horaInicial = $parametros["horaInicial"];
			$query = $query. " AND cm.horario >= '{$horaInicial}'";
		}
		if(isset($parametros["horaFinal"]) && $parametros["horaFinal"] != ""){
			$horaFinal = $parametros["horaFinal"];
			$query = $query. " AND cm.horario <= '{$horaFinal}'";
		}
		if(isset($parametros["cpf_pesquisa"]) && $parametros["cpf_pesquisa"] != ""){
			$cpf = $parametros["cpf_pesquisa"];
			$query = $query." AND c.cpf = '{$cpf}'";
		}
		if(isset($parametros["nome_cliente_pesquisa"]) && $parametros["nome_cliente_pesquisa"] != ""){
			$nome = $parametros["nome_cliente_pesquisa"];
			$query = $query." AND c.nome LIKE '%{$nome}%'";
		}
		if(isset($parametros["veterinario_pesquisa"]) && $parametros["veterinario_pesquisa"] != ""){
			$veterinario_id = $parametros["veterinario_pesquisa"];
			$query = $query." AND cm.veterinario_id = {$veterinario_id}";
		}
		/*  'dataInicial' => string '2017-01-01' (length=10)
  'dataFinal' => string '2017-01-26' (length=10)
  'horaInicial' => string '10:00' (length=5)
  'horaFinal' => string '18:00' (length=5)
  'cpf_pesquisa' => string '44736599847' (length=11)
  'nome_cliente_pesquisa' => string 'Henrique' (length=8)
  'veterinario_pesquisa' => string '41' (length=2)*/
		$query = $query." ORDER BY data ASC, horario ASC";
		$consultasMedicas = DB::select($query);
		return $consultasMedicas;
	}
	public function consulta($consulta_id){
		$query = "SELECT cm.id,cm.data, cm.horario, DATEDIFF(cm.data,NOW()) AS dias_restantes, cm.motivo_id, m.motivo AS motivo_descricao, cm.veterinario_id, v.nome AS veterinario_nome, cm.observacao, cm.animal_id, a.nome AS animal_nome, a.especie_id, e.nome AS especie_nome, e.tipoAnimal_id, t.descricao AS tipo_animal_descricao, a.cliente_id, c.cpf AS cliente_cpf, c.nome AS cliente_nome, c.telefone, c.celular
			FROM consultas_medicas cm
			INNER JOIN motivos_consulta m ON cm.motivo_id = m.id 
			INNER JOIN veterinarios v ON cm.veterinario_id = v.id
			INNER JOIN animais a ON cm.animal_id = a.id
			INNER JOIN especies e ON a.especie_id = e.id
			INNER JOIN tipo_animais t ON e.tipoAnimal_id = t.id
			INNER JOIN clientes c ON a.cliente_id = c.id
			WHERE DATEDIFF(cm.data,NOW()) >= 0
			AND cm.id = {$consulta_id}";
		return DB::select($query);
	}
	public function atualiza($consulta_id,$campos){
		return DB::table("consultas_medicas")->where("id",$consulta_id)->update($campos);
	}
	public function exclui($consulta_id){
		return DB::table("consultas_medicas")->where("id",$consulta_id)->delete();
	}
}
