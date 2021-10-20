<?php

class RelatorioService{

	private $conexao;
	private $relatorio;

	public function __construct(Conexao $conexao, Relatorio $relatorio) {

		$this->conexao = $conexao->conectar();
		$this->relatorio = $relatorio;
	}		
	public function salvarData(){
		$query = "update tb_pesquisa set data = :data_inicio where id = 1; update tb_pesquisa set data = :data_fim where id = 2";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':data_inicio', $this->relatorio->__get('data_inicio'));
		$stmt->bindValue(':data_fim', $this->relatorio->__get('data_fim'));
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function recuperarRelatorio(){
		$query = "select t.id, t.id_user, t.id_status, t.tarefa, t.data_coleta, t.litros, DATE_FORMAT(t.data_cadastrado, '%d/%m/%Y') as data_cadastrado from tb_tarefas as t where t.data_cadastrado between :data_inicio and :data_fim";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':data_inicio', $this->relatorio->__get('data_inicio'));
		$stmt->bindValue(':data_fim', $this->relatorio->__get('data_fim'));
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function coletasPendentes(){
		$query = "select count(id_status) from tb_tarefas where id_status = 1";
		$stmt = $this->conexao->prepare($query);
		//$stmt->bindValue(':data_inicio', $this->relatorio->__get('data_inicio'));
		//$stmt->bindValue(':data_fim', $this->relatorio->__get('data_fim'));
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function coletasConcluidas(){
		$query = "select count(id_status) from tb_tarefas where id_status = 2";
		$stmt = $this->conexao->prepare($query);
		//$stmt->bindValue(':data_inicio', $this->relatorio->__get('data_inicio'));
		//$stmt->bindValue(':data_fim', $this->relatorio->__get('data_fim'));
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function oleoColetado(){
		$query = "select sum(litros) as litros from tb_tarefas where id_status = 2";
		$stmt = $this->conexao->prepare($query);
		//$stmt->bindValue(':data_inicio', $this->relatorio->__get('data_inicio'));
		//$stmt->bindValue(':data_fim', $this->relatorio->__get('data_fim'));
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getDataPesquisa(){
		$query = "select data from tb_pesquisa";
		$stmt = $this->conexao->prepare($query);		
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>