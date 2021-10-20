<?php
	require "validador_acesso.php";
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	</head>

	<body>
		<nav class="navbar navbar-light bg-light" style="background-color: #DDF5DD">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="imagens/logo2.png" width="60" height="50" class="d-inline-block align-top" alt="">
					Listagem de Coletas
				</a>
				<ul class="navbar-nav">
					<li class="text-primary nav-item ml-5 font-weight-bold">
						<?php echo '<span>Usuário: ' . $_SESSION['nome'] . ' </span>'; ?>
												
					</li> 
				</ul>
				<ul class="navbar-nav">  
			        <li class="nav-item">
			          <a href="logoff.php" class="nav-link text-white btn btn-danger btn-block m-1">Sair</a>
			        </li>
				</ul>
			</div>
		</nav>

		<?php if( isset($_GET['inclusao']) && $_GET['inclusao'] == 1) { ?>
			<div class="bg-success pt-2 text-light d-flex justify-content-center">
				<h5>Coleta registrada com sucesso!</h5>
			</div>
		<?php } ?>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="pendente_tarefa.php">Coletas pendentes</a></li>
						<li class="list-group-item active"><a href="#">Nova Coleta</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas Coletas</a></li>
						<li class="list-group-item"><a href="concluida_tarefa.php">Coletas concluídas</a></li>
						<li class="list-group-item"><a href="relatorio.php">Relatório Gerencial</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina bg-light">
						<div class="row">
							<div class="col">
								<h4 class="text-info">Nova Coleta</h4>
								<hr />

								<form method="post" action="tarefa_controler.php?acao=inserir">
									<div class="form-group">
										<label>Cliente:</label>
										<input type="text" class="form-control" name="tarefa" placeholder="Exemplo: Restaurante da Batata">
										<label>Endereço:</label>
										<input type="text" class="form-control" name="endereco" placeholder="Exemplo: Av. Pres. Kennedy">				
										<label>Observação:</label>
										<input type="text" class="form-control" name="obs" placeholder="Exemplo: Troca produto / Pix">
										<?php if($_SESSION['perfil'] == 0) { ?>
										<label for="id_user">Carro:</label>
										<select name="id_user" class="form-control" value="<?= $_SESSION['id'] ?>">
											<option value="2">Kombi</option>
											<option value="3">Strada</option>
										</select>							
										<?php } ?>
										<?php if($_SESSION['perfil'] == 1) { ?>
										<input type="hidden" name="id_user" value="<?= $_SESSION['id'] ?>">
										<?php } ?>	
									</div>
									<?php if(isset($_GET['erro']) && $_GET['erro'] == '6'){?>
                    <div class="text-warning mb-2">Preencha os campos obrigatórios: Cliente e Endereço.</div>
                  <?php };?>

									<button class="btn btn-info">Cadastrar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>