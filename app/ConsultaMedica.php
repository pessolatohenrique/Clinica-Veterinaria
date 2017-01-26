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
	public function lista(){
		$query = "SELECT cm.id,cm.data, cm.horario, DATEDIFF(cm.data,NOW()) AS dias_restantes, cm.motivo_id, m.motivo AS motivo_descricao, cm.veterinario_id, v.nome AS veterinario_nome, cm.observacao, cm.animal_id, a.nome AS animal_nome, a.especie_id, e.nome AS especie_nome, e.tipoAnimal_id, t.descricao AS tipo_animal_descricao, a.cliente_id, c.cpf AS cliente_cpf, c.nome AS cliente_nome, c.telefone, c.celular
			FROM consultas_medicas cm
			INNER JOIN motivos_consulta m ON cm.motivo_id = m.id 
			INNER JOIN veterinarios v ON cm.veterinario_id = v.id
			INNER JOIN animais a ON cm.animal_id = a.id
			INNER JOIN especies e ON a.especie_id = e.id
			INNER JOIN tipo_animais t ON e.tipoAnimal_id = t.id
			INNER JOIN clientes c ON a.cliente_id = c.id
			WHERE DATEDIFF(cm.data,NOW()) >= 0";
		$query = $query." ORDER BY data, horario DESC";
		$consultasMedicas = DB::select($query);
		return $consultasMedicas;
	}
}
