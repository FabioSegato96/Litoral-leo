<?php
	
	$acao = 'pesquisarRelatorio';
	require "relatorio_controler.php";
	require "validador_acesso.php";
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Litoral Óleo</title>

		<link rel="stylesheet" href="estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<!--Jquery e regras-->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="regras.js"></script>
		<script>
			
		</script>
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

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="pendente_tarefa.php">Coletas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova coleta</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas coletas</a></li>
						<li class="list-group-item"><a href="concluida_tarefa.php">Coletas concluídas</a></li>
						<li class="list-group-item active"><a href="#">Relatório Gerencial</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina bg-light mb-2">
						<div class="row">
							<div class="col">
								<h4 class="text-primary">Relatório Gerencial</h4>
								<hr />
								<h5>Selecione as datas da pesquisa:</h5>
								<form action="relatorio_controler.php?acao=salvarData" method="post" class="row">
									<input class="ml-3 form-control col-md-4 align-self-center" type="date" name="data_inicio" id="data_inicio">
									<input class="ml-2 form-control col-md-4 align-self-center" type="date" name="data_fim" id="data_fim">
									<button id="pesquisa" type="submit" class="btn btn-lg col-md-2 ml-4 btn-info" >Pesquisar</button>
								</form>
								<hr />
								<h5>Parâmetros:</h5>
									<div class="row justify-content-center">
										<div class="col-md-3 border rounded m-2 text-center" style="background-color: #F7F2E0;">
											<h4 class="text-warning">Coletas Pendentes:</h4>
											<span class="h5" id="coletas_pendentes">
												<?= $relatorio_pendente[0]['count(id_status)'] ?>
											</span>
										</div>
										<div class="col-md-3 border rounded m-2 text-center" style="background-color: #E0F8E0;">
											<h4 class="text-success">Coletas Concluídas:</h4>
											<span class="h5" id="coletas_concluidas">						
												<?= $relatorio_concluido[0]['count(id_status)'] ?>
											</span>
										</div>
										<div class="col-md-3 border rounded m-2 text-center" style="background-color: #CEE3F6;">
											<h4 class="text-info">Óleo Coletado (litros):</h4>
											<span class="h5" id="oleo_coletado">
												<?= $relatorio_oleo[0]['litros']; ?>
											</span>
										</div>	
									</div>				
								<hr />
								<?php if ($_SESSION['perfil'] == 0) {?>

										<div class="table-responsive">
									      <table class="table table-striped table-bordered table-sm">
									      <thead class="thead-dark">
									        <tr>
									        	<th>Status</th>			
									          <th>Coleta n°</th>
									          <th>Cliente</th>
									          <th>Data Agendada</th>
									          <th>Data Coleta</th>
									          <th>Litros</th>
									          <th>Carro</th>
									        </tr>
									      </thead>
									  										  
									<?php foreach ($relatorio_bd as $key => $value) { ?>
															 								
								      <tbody class="text-center">
								        <tr>
								         <td><?php if($value['id_status'] == 1){
								         	echo '<span class="text-warning">Pendente</span>';
								         }else{
								         	echo '<span class="text-success">Concluído</span>';
								         } ?>								         	
								         </td>	
								          <td><?= $value['id'] ?></td>
								          <td><?= $value['tarefa'] ?></td>
								          <td><?= $value['data_cadastrado'] ?></td>
								          <td><?= $value['data_coleta'] ?></td>
								          <td><?= $value['litros'] ?></td>
								          <td><?php if ($value['id_user'] == 2) {
								          			echo "Kombi";
								          		} else {
								          			echo "Strada";
								          		}?>								          	
								          </td>
								        </tr>							        
								     </tbody>
								     </div>
								  													
									</div>								
								</div>
								</div>								
									<?php } ?>
								<?php } ?>													
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>