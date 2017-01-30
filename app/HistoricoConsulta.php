<?php namespace ClinicaVeterinaria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class HistoricoConsulta extends Model {
	public $timestamps = false;
	protected $table = "consultas_veterinario";
	protected $fillable = ["veterinario_id", "animal_id", "data", "sintomas", "diagnostico", "tratamento",
	"tratamento_encerrado"];
	/*listagem de consultas realizadas filtrando por veterinário*/
	public function lista($veterinario_id){
		/*SELECT cv.veterinario_id, cv.id, cv.data, c.nome AS cliente_nome ,cv.animal_id, a.nome AS animal_nome, e.nome AS especie_nome, t.descricao AS tipo_animal, cv.sintomas, cv.diagnostico, cv.tratamento, cv.tratamento_encerrado
			FROM consultas_veterinario cv
			INNER JOIN animais a ON cv.animal_id = a.id
			INNER JOIN clientes c ON a.cliente_id = c.id
			INNER JOIN especies e ON a.especie_id = e.id
			INNER JOIN tipo_animais t ON e.tipoAnimal_id = t.id
			WHERE cv.veterinario_id = 13*/
		$query = "SELECT cv.veterinario_id, cv.id, cv.data, c.nome AS cliente_nome ,cv.animal_id, a.nome AS animal_nome, e.nome AS especie_nome, t.descricao AS tipo_animal, cv.sintomas, cv.diagnostico, cv.tratamento, cv.tratamento_encerrado
			FROM consultas_veterinario cv
			INNER JOIN animais a ON cv.animal_id = a.id
			INNER JOIN clientes c ON a.cliente_id = c.id
			INNER JOIN especies e ON a.especie_id = e.id
			INNER JOIN tipo_animais t ON e.tipoAnimal_id = t.id
			WHERE cv.veterinario_id = 13";
		$query = $query." ORDER BY cv.data DESC"; 
		return DB::select($query);
	}
}
