<?php
require "tarefa_model.php";
require "relatorio_model.php";
require "tarefa_service.php";
require "relatorio_service.php";
require "conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;


if ($acao == 'pesquisarRelatorio') {	

		$relatorio = new Relatorio();
		$conexao = new Conexao();
		$relatorioService = new RelatorioService($conexao, $relatorio);		
		$relatorioService->getDataPesquisa();		
					
			$data_inicio = $relatorioService->getDataPesquisa()[0]['data'];		
			$data_fim = $relatorioService->getDataPesquisa()[1]['data'];
	
	$relatorio->__set('data_inicio', $data_inicio);
	$relatorio->__set('data_fim', $data_fim);	
	$relatorio->__set('coletasPendentes', $relatorioService->coletasPendentes());
	$relatorio->__set('coletasConcluidas', $relatorioService->coletasConcluidas());
	$relatorio->__set('oleoColetado', $relatorioService->oleoColetado());
	$relatorio_bd = $relatorioService->recuperarRelatorio();
	$relatorio_pendente = $relatorioService->coletasPendentes();
	$relatorio_concluido = $relatorioService->coletasConcluidas();
	$relatorio_oleo = $relatorioService->oleoColetado();
		
} else if ($acao == 'salvarData')
		$relatorio = new Relatorio();				
		if (isset($_POST['data_inicio'])) {
			$data_inicio = $_POST['data_inicio'];
		} 
		if (isset($_POST['data_fim'])) {
			$data_fim = $_POST['data_fim'];
		}	
	
	$relatorio->__set('data_inicio', $data_inicio);
	$relatorio->__set('data_fim', $data_fim);
	
	$conexao = new Conexao();
	$relatorioService = new RelatorioService($conexao, $relatorio);
	
	if($relatorioService->salvarData()){
	$relatorio_bd = $relatorioService->recuperarRelatorio();		
		header('Location: relatorio.php');
	}	
?>