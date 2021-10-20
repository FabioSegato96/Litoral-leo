<?php
	session_start();

	//remover indices ro array de sessão
	//unset()
/***************************/
	//destruir a variável de sessão
	//session_destroy()

	session_destroy();//será destruída, porém apenas na proxima requisição não teremos mais acesso as variáveis.

	header('Location: index.html');

?>