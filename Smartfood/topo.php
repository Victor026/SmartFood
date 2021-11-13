<?php
require('vendor/autoload.php');
include 'sessao/Login.php';
include_once 'entidades/Mensagem.php';
include $_SERVER['DOCUMENT_ROOT'].'/Smartfood/Database/database.php';

// Altera a tela inicial para usuários e restaurantes
if (Login::isLogged()) {
  if ($_SESSION['usuario']['acesso'] == 'u') {
    $home_login = 'pag-inicial-adm.php';
    $meus_pedidos = 'pedidos.php';
  } else {
    $home_login = 'pag-inicial-res.php';
    $meus_pedidos = 'restaurante-pedidos.php';
  }
}

// Altera a tela de pedidos para usuários e restaurantes
if (Login::isLogged()) {
  if ($_SESSION['usuario']['acesso'] == 'u') {

  } else {

  }
}

// Alerta que aparece quando há um pedido não finalizado
$finalizar_pedido = '';
// Alerta caso existam pedidos em abertos
$pedidos_abertos = '';
$usuario = Login::get_usuario_logado();
date_default_timezone_set('America/Sao_Paulo');
$enviaContato = '';
$home_a = '';
$dados_a = '';

// Verifica se há algum pedido não finalizado e exibe "Finalizar pedido"
if (Login::isLogged()) {
  if ($_SESSION['usuario']['pedido'] and $_SERVER['REQUEST_URI'] != '/Smartfood/finalizar-pedido.php' and $_SERVER['REQUEST_URI'] != '/Smartfood/comprar.php') {
    $finalizar_pedido = ' <a href="finalizar-pedido.php" class="texto-pedido-aberto">
    <div class="pedido-aberto">
      <p style="margin-bottom: 0 !important;">Finalizar pedido</p>
    </div>
   </a>';
  }
}

// Verifica se há pedidos abertos ou processados e exibe "Exibir pedidos não finalizados"

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- CSS Principal -->
    <link rel="stylesheet" href="/Smartfood/src/css/main_2.css">
    <title>Smart Food</title>
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="<?php if (Login::isLogged()) { echo $home_login; } else { echo 'pag-inicial-adm.php'; }?>">Smart Food</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" style="background-color: rgb(52, 58, 64); z-index: 999;" id="navbarNavDropdown">

          <?php
          if (Login::isLogged()) {
            echo '   <ul class="navbar-nav"> <li class="nav-item">
               <a class="nav-link" href="'.$home_login.'">Restaurantes</a>
             </li><li class="nav-item">
                    <!--  <a class="nav-link" href="'.$meus_pedidos.'">Meus dados</a> -->
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="'.$meus_pedidos.'">Meus pedidos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="logout.php">Deslogar</a>
                    </li></ul>';
          } ?>

      </div>
    </div>
  </nav>

  <div id="novas-mensagens"></div>

  <?=$finalizar_pedido?>
