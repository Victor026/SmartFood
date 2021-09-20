<?php
  include 'topo.php';
  include 'rodape.php';
  include 'entidades/Prato_Pedido.php';
  include 'entidades/Pedido.php';

  // Atribui o prato selecionado
  $prato = $_POST['prato'];

  // Caso o pedido ainda não exista
  if (!$_POST['pedido']) {
    // Cria o pedido
    $pedido = new Pedido;
    $pedido->id_situacao = 1;
    $pedido->id_pessoa = $_POST['id_usuario'];
    $pedido->id_restaurante = $_POST['restaurante'];
    $pedido->cadastrar();
    $_POST['pedido'] = $pedido->id;
  }

  $prato_pedido = new Prato_Pedido;
  $prato_pedido->id_prato = $_POST['prato'];
  $prato_pedido->id_pedido = $_POST['pedido'];
  $prato_pedido->qtd_prato = $_POST['quantidade'];
  $prato_pedido->cadastrar();
  header('location: restaurante.php?restaurante='.$_POST['restaurante'].'&pedido='.$_POST['pedido']);
  exit;




 ?>
