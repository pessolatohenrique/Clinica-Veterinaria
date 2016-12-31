<?php namespace ClinicaVeterinaria\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Request;
class VeterinarioController extends Controller {
	public function lista(){
		$veterinarios = DB::select("SELECT v.*,e.nome AS especialidade_descricao 
			FROM veterinarios v INNER JOIN especialidades e ON v.especialidade_id = e.id 
			ORDER BY v.nome");
		$dados = array("veterinarios" => $veterinarios);
		return view("veterinario/listagem")->with($dados);
	}
	public function consulta($veterinario_id){
		$veterinario = DB::select("SELECT v.*,e.nome AS especialidade_descricao 
			FROM veterinarios v INNER JOIN especialidades e ON v.especialidade_id = e.id 
			WHERE v.id = ?",[$veterinario_id]);
		$dados = array("veterinario" => $veterinario);
		return view("veterinario/consulta")->with($dados);
	}
	/*retorna o formulário para adicionar ou atualizar um veterinário*/
	public function formulario(){
		$especialidades = DB::select("SELECT * FROM especialidades ORDER BY nome ASC");
		$dados = array("especialidades" => $especialidades);
		return view("veterinario/formulario")->with($dados);
	}
	public function adiciona(){
		$vetor = array();
		$vetor["cpf"] = documentToDataBase(Request::input("cpf"));
		$vetor["crmv"] = documentToDataBase(Request::input("crmv"));
		$vetor["nome"] = Request::input("nome");
		$vetor["email"] = Request::input("email");
		$vetor["telefone"] = phoneToDataBase(Request::input("telefone"));
		$vetor["celular"] = phoneToDataBase(Request::input("celular"));
		$vetor["especialidade"] = Request::input("especialidade");
		$vetor["data"] = convertDateToAmerican(Request::input("dataAdmissao"));
		$vetor["horaEntrada"] = Request::input("horaEntrada");
		$vetor["horaSaida"] = Request::input("horaSaida");
		$vetor["login"] = Request::input("login");
		$vetor["senha"] = MD5(Request::input("senha"));
		/*inserção na tabela veterinarios*/
		DB::insert("INSERT INTO veterinarios(especialidade_id, cpf, crmv, nome, email, telefone, celular, dataAdmissao, horaEntrada, horaSaida) VALUES (?,?,?,?,?,?,?,?,?,?)",[$vetor["especialidade"],$vetor["cpf"],$vetor["crmv"],$vetor["nome"],$vetor["email"],$vetor["telefone"],$vetor["celular"],$vetor["data"],$vetor["horaEntrada"],$vetor["horaSaida"]]);
		/*inserção na tabela login*/
		DB::insert("INSERT INTO login(login,senha,cargo) VALUES (?,?,?)",[$vetor["login"],$vetor["senha"],"VET"]);
		return redirect("/veterinario")->withInput(Request::only("nome"));
	}
}