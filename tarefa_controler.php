<?php
require "tarefa_model.php";
require "relatorio_model.php";
require "tarefa_service.php";
require "relatorio_service.php";
require "conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;


if ($acao == 'inserir') {
	if ($_POST['tarefa'] != '' && $_POST['endereco'] != '' && $_POST['id_user'] != '') {
		$tarefa = new Tarefa();
		$tarefa->__set('tarefa', ucfirst($_POST['tarefa']));
		$tarefa->__set('endereco', ucfirst($_POST['endereco']));
		$tarefa->__set('obs', ucfirst($_POST['obs']));
		$tarefa->__set('id_user', ucfirst($_POST['id_user']));

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->inserir();

		header('Location: nova_tarefa.php?inclusao=1');
	}else{ 
		header('Location: nova_tarefa.php?erro=6');
	}
} else if ($acao == 'recuperar') {
	$tarefa = new Tarefa();
	$conexao = new Conexao();
	$tarefaService = new TarefaService($conexao, $tarefa);
	$tarefas_bd = $tarefaService->recuperar();
} elseif ($acao == 'atualizar') {	
	$tarefa = new Tarefa();
	$tarefa->__set('id', $_POST['id']);
	$tarefa->__set('litros', $_POST['litros']);

	$conexao = new Conexao();
	$tarefaService = new TarefaService($conexao, $tarefa);
	if ($tarefaService->atualizar()) {
		header('Location: pendente_tarefa.php');
	}
} elseif ($acao == 'remover') {

	$tarefa = new Tarefa();
	$tarefa->__set('id', $_GET['id']);

	$conexao = new Conexao();

	$tarefaService = new TarefaService($conexao, $tarefa);
	$tarefaService->remover();
	header('Location: todas_tarefas.php');
} elseif ($acao == 'marcarRealizada') {
	$dataAtual = date('d/m/Y');	
	$tarefa = new Tarefa();
	$tarefa->__set('id', $_GET['id']);
	$tarefa->__set('id_status', 2);
	$tarefa->__set('data_coleta', $dataAtual);
	$conexao = new Conexao();

	$tarefaService = new TarefaService($conexao, $tarefa);
	$tarefaService->marcarRealizada();

	header('Location: todas_tarefas.php');
} elseif ($acao == 'recuperarTarefasPendentes') {
	
	$tarefa = new Tarefa();
	$tarefa->__set('id_status', 1);

	$conexao = new Conexao();

	$tarefaService = new TarefaService($conexao, $tarefa);
	$tarefas = $tarefaService->recuperarTarefasPendentes();	
} elseif ($acao == 'atualizarObs') {
	
	$tarefa = new Tarefa();
	$tarefa->__set('id', $_POST['id']);
	$tarefa->__set('obs', $_POST['obs']);

	$conexao = new Conexao();
	$tarefaService = new TarefaService($conexao, $tarefa);
	if ($tarefaService->atualizarObs()) {
		header('Location: pendente_tarefa.php');
	} 
} elseif ($acao == 'updateData') {
	$data_remarcada = str_replace('-', '/', $_POST['data_remarcada']);
	$divisor = explode('/', $data_remarcada);
	$divisor = array_reverse($divisor);
	$divisor = implode('/', $divisor);
	$tarefa = new Tarefa();
	$tarefa->__set('id', $_POST['id']);
	$tarefa->__set('data_remarcada', $divisor);

	$conexao = new Conexao();
	$tarefaService = new TarefaService($conexao, $tarefa);
	if ($tarefaService->atualizarRemarcada()) {
		header('Location: pendente_tarefa.php');
	}
} elseif ($acao == 'marcarUrgencia') {	
	$tarefa = new Tarefa();
	$tarefa->__set('id', $_GET['id']);	
	$tarefa->__set('id_urgencia', 2);
	$conexao = new Conexao();

	$tarefaService = new TarefaService($conexao, $tarefa);
	$tarefaService->marcarUrgencia();

	header('Location: todas_tarefas.php');
} 
?>