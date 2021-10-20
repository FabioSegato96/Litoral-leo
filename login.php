<?php

  $acao = 'recuperarUsuario';
  require "tarefa_controler.php";

?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <style>
      .card-login {
        padding: 30px 0 0 0;
        width: 350px;
        margin: 0 auto;
      }      
    </style>
    <script>
      function alertLogin(){
      alert('Olá, seja bem vindo ao App AuTarefas! Buscando proporcionar a melhor experiência para o usuário, nossa equipe está desenvolvendo funcionalidades que permitem cadastrar logins automaticamente. Enquanto isso, vai lá dar uma conferida no app, use esse Login e Senha > Login: user@teste.com.br  Senha: 123456');
    }  
    </script>
    <link rel="icon" href="img/logonew2.png">    
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-light sticky-top pb-5" style="background-color: #DDF5DD">
        <a href="#" class="navbar-brand text-success display-2 font-weight-bold ml-5"><img src="imagens/logo2.png" width="60" height="50" class="d-inline-block align-items-center " id="nome_app" alt="" class="ml-5" style="margin-left: 60px;"></a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navtarget3">
          <span class="navbar-toggler-icon"></span>

        </button>    
                
      </nav>

    <div class="container">    
      <div class="row">

        <div class="card-login col-sm-6">
          <div class="card">
            <div class="card-header">
              Login
            </div>
            <div class="card-body">
              <form action="valida_login.php?acao=recuperarUsuario" method="post">
                <div class="form-group">
                  <input name="email" type="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <input name="senha" type="password" class="form-control" placeholder="Senha">
                  <?php if(isset($_GET['login']) && $_GET['login'] == 'erro'){?>
                    <div class="text-danger">Usuário ou senha invalido(s).</div>
                  <?php };?>
                  <?php if(isset($_GET['login']) && $_GET['login'] == 'erro2'){?>
                    <div class="text-warning">Faça login antes de acessar outras páginas.</div>
                  <?php };?> 



                </div>
                <button class="btn btn-lg btn-success btn-block" name="entrar" type="submit">Entrar</button>                
              </form>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>