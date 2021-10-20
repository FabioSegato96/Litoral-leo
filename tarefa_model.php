<?php

	class Tarefa{

		private $id;
		private $id_status;
		private $id_user;
		private $tarefa;
		private $data_cadastro;
		private $endereco;
		private $litros;
		private $obs;
		private $data_coleta;
		private $data_remarcada;
		private $id_urgencia;

		public function __get($atributo) {
			return $this->$atributo;
		}
		public function __set($atributo, $valor) {
			$this->$atributo = $valor;
		}
	}

?>