$(document).ready(() => {
$('#pesquisa').on('click', e => {

		let data_inicio = $('#data_inicio').val()
		let data_fim = $('#data_fim').val()		

		$.ajax({
			type: 'GET',
			url: 'tarefa_controler.php?acao=pesquisarRelatorio',
			data: `data_inicio=${data_inicio}&data_fim=${data_fim}`,
			dataType: 'json',
			success: dados => {
				$('#coletas_pendentes').html(dados.coletasPendentes)
				$('#coletas_concluidas').html(dados.coletasConcluidas)
				$('#oleo_coletado').html(dados.oleoColetado)				
			},
			error: erro => {console.log(erro)}
		})
	})
})				