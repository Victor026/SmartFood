<?php
  include 'topo.php';
  include 'entidades/Pedido.php';

  $pedido = Pedido::consultar_pedido( $_GET['pedido'] );

  // Validação do pedido
  if (!$pedido instanceof Pedido) {
    header('location:pag-inicial-res.php');
    exit;
  }

  // Muda o status do pedido para "Recusado"
  $pedido->id_situacao = 5;
  $pedido->atualizar();
  header('location:restaurante-pedidos.php');
  exit;

 ?>
