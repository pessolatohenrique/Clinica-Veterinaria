<?php namespace ClinicaVeterinaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Cliente extends Model {
	public $timestamps = false;
	//campo fillable
	public function lista(){
		/*SELECT c.*, e.* FROM `clientes` c INNER JOIN enderecos e ON c.endereco_id = e.id ORDER BY c.nome ASC*/
		$clientes = DB::table('clientes AS c')
		->join("enderecos AS e","c.endereco_id","=","e.id")
		->select("c.*","e.*")
		->orderBy("c.nome","ASC")
		->get();
		return $clientes;
	}
}
