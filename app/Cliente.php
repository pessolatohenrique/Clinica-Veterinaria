<?php namespace ClinicaVeterinaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Cliente extends Model {
	public $timestamps = false;
	protected $fillable = ['cpf','rg','nome','telefone','celular','email','endereco_id'];
	public function lista(){
		/*SELECT c.*, e.* FROM `clientes` c INNER JOIN enderecos e ON c.endereco_id = e.id ORDER BY c.nome ASC*/
		$clientes = DB::table('clientes AS c')
		->join("enderecos AS e","c.endereco_id","=","e.id")
		->select("c.*","e.*")
		->orderBy("c.nome","ASC")
		->get();
		return $clientes;
	}
	public function adicionaEndereco($vetor){
		// "cep","logradouro","numero","complemento","bairro","cidade","estado"
		DB::table("enderecos")->insert([
			'cep' => $vetor['cep'], 'logradouro' => $vetor['logradouro'],
			'numero' => $vetor['numero'], 'complemento' => $vetor['complemento'],
			'bairro' => $vetor['bairro'], 'cidade' => $vetor['cidade'],
			'estado' => $vetor['estado']
		]);
		return DB::select('SELECT LAST_INSERT_ID() AS endereco_id');
	}
}
