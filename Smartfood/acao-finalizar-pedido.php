<?php

  include 'topo.php';
  include 'entidades/Pedido.php';
  include 'entidades/Prato.php';
  include 'entidades/Prato_Pedido.php';

  // Caso tenha sido escolhida a opção de finalizar o pedido
  if (isset($_POST['finalizar'])) {

    header('location:comprar.php');
    exit;

  }

  // Caso tenha sido escolhida a opção de adicionar pratos
  // é redirecionado pra página do restaurante
  if (isset($_POST['adicionar'])) {
    header('location:restaurante.php?restaurante='.$_POST['restaurante']);
    exit;
  }

  // Caso tenha sido escolhida a opção de cancelar o pedido
  if (isset($_POST['cancelar'])) {
    $_SESSION['usuario']['pedido'] = array();
    header('location:pag-inicial-adm.php');
    exit;
  }

 ?>
