<?php
  include 'topo.php';
  include 'rodape.php';
  include 'entidades/Prato_Pedido.php';
  include 'entidades/Pedido.php';

  // Appenda o prato à variável na sessão
  echo "<pre>"; print_r($_SESSION['pedido']); echo "</pre>"; exit;
  array_push($_SESSION['pedido'], [$_POST['prato'], $_POST['quantidade']]);

  header('location:restaurante.php?restaurante.php?restaurante='.$restaurante->id);
  exit;

 ?>
