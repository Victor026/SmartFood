<?php
require('vendor/autoload.php');
include 'sessao/Login.php';
include $_SERVER['DOCUMENT_ROOT'].'/Smartfood/Database/database.php';
$usuario = Login::get_usuario_logado();
date_default_timezone_set('America/Sao_Paulo');
$enviaContato = '';
$home_a = '';
$dados_a = '';
if (!isset($page)) {
  $page = '';
}
if ($page == 'home') {
  $home_a = 'active';
} else if ($page == 'dados') {
  $dados_a = 'active';
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- CSS Principal -->
    <link rel="stylesheet" href="src/css/main_2.css">
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Smart Food</title>
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="pag-inicial-adm.php">Smart Food</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" style="background-color: rgb(52, 58, 64); z-index: 999;" id="navbarNavDropdown">

          <?php
          if (Login::isLogged()) {
            echo '   <ul class="navbar-nav"> <li class="nav-item">
               <a class="nav-link" href="pag-inicial-adm.php">Restaurantes</a>
             </li><li class="nav-item">
                    <!--  <a class="nav-link" href="meus-dados.php">Meus dados</a> -->
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="logout.php">Deslogar</a>
                    </li></ul>';
          } ?>

      </div>
    </div>

  </nav>