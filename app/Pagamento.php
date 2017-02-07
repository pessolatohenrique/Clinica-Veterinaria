<?php namespace ClinicaVeterinaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Pagamento extends Model {
	public $timestamps = false;
	protected $table = "pagamentos";
	protected $fillable = ["consulta_id","valor","status"];
	public function lista(){
		$query = "SELECT p.id, cv.id AS consulta_id, cv.data, p.valor, c.nome AS cliente_nome, a.nome AS animal_nome, cv.sintomas, cv.diagnostico, cv.tratamento, p.status 
			FROM pagamentos p 
			INNER JOIN consultas_veterinario cv ON p.consulta_id = cv.id
			INNER JOIN animais a ON cv.animal_id = a.id
			INNER JOIN clientes c ON a.cliente_id = c.id";
		$query = $query." ORDER BY cv.data DESC";
		return DB::select($query);
	}
}
