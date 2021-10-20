<?php

session_start();

//Variável que verifica se autenticação foi realizada
$usuario_autenticado = false;
$usuario_id = null;
$usuario_tipo = null;
$usuario_perfil = null;

$usuarios_app = array(

	array('id' => 1, 'nome' => 'Administrador' , 'email' => 'adm@litoraloleo.com', 'senha' => '123456', 'perfil' => '0'),
	array('id' => 2, 'nome' => 'Kombi', 'email' => 'kombi@litoraloleo.com', 'senha' => '123456', 'perfil' => '1'),
	array('id' => 3, 'nome' => 'Strada', 'email' => 'strada@litoraloleo.com', 'senha' => '123456', 'perfil' => '1')
);

foreach ($usuarios_app as $user) {	

	if ($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']) {
		$usuario_autenticado = true;
		$usuario_id = $user['id'];
		$usuario_nome = $user['nome'];		
		$usuario_perfil = $user['perfil'];
	}
}
	if ($usuario_autenticado) {
		$_SESSION['autenticado'] = 'SIM';
		$_SESSION['id'] = $usuario_id;
		$_SESSION['nome'] = $usuario_nome;		
		$_SESSION['perfil'] = $usuario_perfil;
		header('Location: pendente_tarefa.php'); 
	}else{
		header('Location: login.php?login=erro');
		$_SESSION['autenticado'] = 'NÃO';
	}



?>