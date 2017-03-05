<?php namespace ClinicaVeterinaria\Http\Controllers;

use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ClinicaVeterinaria\Pagamento;

class PagamentoController extends Controller {
	public function __construct(){
		$this->middleware("autorizaVeterinario");
	}
	public function lista(Request $request){
		$pagamentoObj = new Pagamento();
		$parametros = $request->all();
		$pagamentos = $pagamentoObj->lista($parametros);
		$dados = array("pagamentos" => $pagamentos);
		return view("pagamento/listagem")->with($dados);
	}
	public function formulario_pesquisa(){
		return view("pagamento/pesquisa");
	}
	public function atualiza(Request $request){
		$pagamentoObj = new Pagamento();
		$pagamento_id = $request->input("pagamento_id");
		$parametros["status"] = $request->input("status");
		$pagamentoObj->atualiza($pagamento_id,$parametros);
	}
	public function criaRelatorioPDF(){
		// $bin = PhantomInstaller\PhantomBinary::getBin();
		// echo $bin;
		// $conversor = new Converter();
		// $conversor->setBinary('vendor/bin/phantomjs');

		// $conversor->addPage("
		// 	<html>
		// 		<body>
		// 			<h1>Título Teste</h1>
		// 			<p>Aqui irá um texto explicativo</p>
		// 			<p>Aqui irá uma tabela qualquer</p>
		// 		</body>
		// 	</html>
		// ")->save("C:\xampp\htdocs\Projetos\ClinicaVeterinaria\public\relatorios");
	}
}
