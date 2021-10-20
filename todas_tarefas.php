<?php

	$acao = 'recuperar';
	require "tarefa_controler.php";
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
		<script>
			function editar(id, litros) {
				let form = document.createElement('form')
				form.action = 'tarefa_controler.php?acao=atualizar'
				form.method = 'post'
				form.className = 'row'
				let inputTarefa = document.createElement('input')
				inputTarefa.type = 'text'
				inputTarefa.name = 'litros'
				inputTarefa.className = 'form-control col-md-9'
				inputTarefa.value = litros

				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = id

				let button = document.createElement('button')
				button.type = 'submit'
				button.className = 'btn btn-info col-md-3'
				button.innerHTML = 'Atualizar'

				form.appendChild(inputTarefa)

				form.appendChild(inputId)

				form.appendChild(button)

				let tarefa = document.getElementById('tarefa_'+id)

				tarefa.innerHTML = ''

				tarefa.insertBefore(form, tarefa[0])
			}
			function editarData(id) {
				let form = document.createElement('form')
				form.action = 'tarefa_controler.php?acao=updateData'
				form.method = 'post'
				form.className = 'row'
				let inputTarefa = document.createElement('input')
				inputTarefa.type = 'date'
				inputTarefa.name = 'data_remarcada'
				inputTarefa.className = 'form-control col-md-9'
				inputTarefa.value = ''

				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = id

				let button = document.createElement('button')
				button.type = 'submit'
				button.className = 'btn btn-info col-md-3'
				button.innerHTML = 'Atualizar'

				form.appendChild(inputTarefa)

				form.appendChild(inputId)

				form.appendChild(button)

				let tarefa = document.getElementById('tarefa_'+id)

				tarefa.innerHTML = ''

				tarefa.insertBefore(form, tarefa[0])
			}

			function editarObs(id, obs) {
				let form = document.createElement('form')
				form.action = 'tarefa_controler.php?acao=atualizarObs'
				form.method = 'post'
				form.className = 'row'
				let inputTarefa = document.createElement('input')
				inputTarefa.type = 'text'
				inputTarefa.name = 'obs'
				inputTarefa.className = 'form-control col-md-9'
				inputTarefa.value = obs

				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = id

				let button = document.createElement('button')
				button.type = 'submit'
				button.className = 'btn btn-info col-md-3'
				button.innerHTML = 'Atualizar'

				form.appendChild(inputTarefa)

				form.appendChild(inputId)

				form.appendChild(button)

				let tarefa = document.getElementById('tarefa_'+id)

				tarefa.innerHTML = ''

				tarefa.insertBefore(form, tarefa[0])
			}			

			function remover(id) {

				location.href = 'todas_tarefas.php?acao=remover&id=' + id;
			}
			function marcarRealizada(id) {

				location.href = 'todas_tarefas.php?acao=marcarRealizada&id=' + id;	
			}
			function marcarUrgencia(id) {

				location.href = 'todas_tarefas.php?acao=marcarUrgencia&id=' + id;	
			}
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

		<div class="container app mb-2">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="pendente_tarefa.php">Coletas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova coleta</a></li>
						<li class="list-group-item active"><a href="#">Todas coletas</a></li>
						<li class="list-group-item"><a href="concluida_tarefa.php">Coletas concluídas</a></li>
						<li class="list-group-item"><a href="relatorio.php">Relatório Gerencial</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina bg-light">
						<div class="row">
							<div class="col">
								<h4 class="text-info">Todas Coletas</h4>
								<hr />

								<?php if ($_SESSION['perfil'] == 0) {?>
									<?php foreach ($tarefas_bd as $key => $value) { ?>

								
									<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9" id="tarefa_<?=$value['id']?>">
										<p class="mb-0">	
											<span class="text-dark h5">Coleta N°</span>
											<span class="h5 text-danger"><?= $value['id']; ?></span>
										</p>										 
										<p class="mb-0">
										<span class="text-primary">Cliente:</span> 
										<span><?= $value['tarefa'] ?></span>
										</p>
																							
										<p class="text-dark d-inline">
											<span class="text-primary">Endereço:</span> 
											<?= $value['endereco'] ?>
										</p>
										<p class="mb-0">
											<span class="text-primary">Urgência:</span>
											<?php if($value['id_urgencia'] == 1) {
												echo '<span class="text-dark">Visita</span>';
											} else {
												echo '<span class="text-danger">Ligou</span>';
											}  ?>
										</p>
										 
										<p class="text-dark d-inline">
											<span class="text-primary">Agendada:</span>  
											<?= $value['data_cadastrado'] ?>					
										</p>
										<br> 									
										<p class="text-dark d-inline">
												<span class="text-primary">Remarcada:</span>  
												<?= $value['data_remarcada'] ?>				
										</p>
										<br> 												 
										<p class="text-dark d-inline">
											<span class="text-primary">Litros:</span> 
											<?= $value['litros'] ?>
										</p>
										<br>							
										<p class="text-dark d-inline">
											<span class="text-primary">Observação:</span> 
											<?= $value['obs'] ?>
										</p>
										<br>										
										<?php 
										if ($value['id_status'] == 1) {
											echo '<p class="text-warning d-inline">
													<span class="text-primary">Status:</span> Pendente
													</p>';
										} elseif ($value['id_status'] == 2) {
											echo '<p class="text-success d-inline">
													<span class="text-primary">Status:</span> Concluído
													</p>';
										} ?>																
										
									</div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<?php if($_SESSION['perfil'] == 0){ ?> 
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $value['id'] ?>)"></i>
										<?php } ?>

										<?php if ($value['id_status'] == 1) {?>
										<i class="far fa-calendar fa-lg text-dark" onclick="editarData(<?=$value['id']?>)"></i>
										<i class="fas fa-edit fa-lg text-info" onclick="editarObs(<?=$value['id']?>, '<?=$value['obs']?>')"></i>
										<i class="fas fa-phone fa-lg text-info" onclick="marcarUrgencia(<?= $value['id'] ?>)"></i>
										<i class="fas fa-tint fa-lg text-warning" onclick="editar(<?=$value['id']?>, '<?=$value['litros']?>')"></i>
										<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $value['id'] ?>)"></i>

										<?php } ?>
									</div>
								</div>
								<hr>
								<?php } ?>
								<?php } ?>
								<!------>
								<?php if ($_SESSION['perfil'] == 1) {?>
									<?php foreach ($tarefas_bd as $key => $value) { ?>
									<?php if ($_SESSION['id'] == $value['id_user']) {?>			
								
								<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9" id="tarefa_<?=$value['id']?>"> 
										<p class="mb-0">	
											<span class="text-dark h5">Coleta N°</span>
											<span class="h5 text-danger"><?= $value['id']; ?></span>
										</p>										 
										<p class="mb-0">
										<span class="text-primary">Cliente:</span> 
										<span><?= $value['tarefa'] ?></span>
										</p>
								
									<p class="text-dark d-inline">
											<span class="text-primary">Endereço:</span> 
											<?= $value['endereco'] ?>
										</p> 
									<br>
										<p class="mb-0">
											<span class="text-primary">Urgência:</span>
											<?php if($value['id_urgencia'] == 1) {
												echo '<span class="text-dark">Visita</span>';
											} else {
												echo '<span class="text-danger">Ligou</span>';
											}  ?>
										</p>												 
									 	<p class="mb-0 text-dark d-inline">
											<span class="text-primary">Agendada:</span>  
											<?= $value['data_cadastrado'] ?>					
										</p> 
									<br> 
										<p class="text-dark d-inline">
												<span class="text-primary">Remarcada:</span>  
												<?= $value['data_remarcada'] ?>				
										</p> 
									<br> 										 
										<p class="text-dark d-inline">
											<span class="text-primary">Litros:</span> 
											<?= $value['litros'] ?>
										</p>
									<br> 
										<p class="text-dark d-inline">
											<span class="text-primary">Observação:</span> 
											<?= $value['obs'] ?>
										</p>
									<br>	
										<?php 
										if ($value['id_status'] == 1) {
											echo '<p class="text-warning d-inline">
													<span class="text-primary">Status:</span> Pendente
													</p>';
										} elseif ($value['id_status'] == 2) {
											echo '<p class="text-success d-inline">
													<span class="text-primary">Status:</span> Concluído
													</p>';
										} ?>																
										
									</div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<?php if($_SESSION['perfil'] == 0){ ?> 
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $value['id'] ?>)"></i>
										<?php } ?>

										<?php if ($value['id_status'] == 1) {?>
										<i class="far fa-calendar fa-lg text-dark" onclick="editarData(<?=$value['id']?>)"></i>
										<i class="fas fa-edit fa-lg text-info" onclick="editarObs(<?=$value['id']?>, '<?=$value['obs']?>')"></i>
										<i class="fas fa-tint fa-lg text-warning" onclick="editar(<?=$value['id']?>, '<?=$value['litros']?>')"></i>
										<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $value['id'] ?>)"></i>

										<?php } ?>
									</div>
								</div>
								<hr>
								<?php } ?>
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