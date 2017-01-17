<?php namespace ClinicaVeterinaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Cliente extends Model {
	public $timestamps = false;
	protected $fillable = ['cpf','rg','nome','telefone','celular','email','endereco_id'];
	public function lista(){
		$clientes = DB::table('clientes AS c')
		->join("enderecos AS e","c.endereco_id","=","e.id")
		->select("c.*","e.*","c.id AS cliente_id")
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
	public function existeEndereco($vetor){
		// SELECT * FROM `enderecos` WHERE cep = '09551200' AND numero = '291' AND complemento = 'Casa 4'
		return DB::table("enderecos")->where("cep",$vetor["cep"])->where("numero",$vetor["numero"])->where("complemento",$vetor["complemento"])->first();
	}
	public function consulta($cliente_id){
		$cliente = DB::table('clientes AS c')
		->join("enderecos AS e","c.endereco_id","=","e.id")
		->where("c.id","=",$cliente_id)
		->select("c.*","e.*","c.id AS cliente_id")
		->first();
		return $cliente;
	}
	public function atualiza($cliente_id,$campos){
		return DB::table("clientes")->where("id",$cliente_id)->update($campos);
	}
}
