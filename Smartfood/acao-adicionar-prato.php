<?php
  include 'topo.php';
  include 'rodape.php';
  include 'entidades/Prato_Pedido.php';
  include 'entidades/Pedido.php';

  $adicionar = 0;
  $dar_push = 1;

  // Dá loop nos pratos do pedido
  foreach ($_SESSION['usuario']['pedido'] as &$prato) {

    // Verifica o id e a quantidade de cada prato
    foreach ($prato as $key => $value) {

      // Verifica se o id prato já está na sessão
      if ($key == 0 and $value == $_POST['prato']) {
        $adicionar = 1;
        $dar_push = 0;
      }

      // Se a variável adicionar estiver = true adiciona a quantidade a já existente
      if ($key == 1 and $adicionar == 1) {
        $value += $_POST['quantidade'];
        $prato[$key] = $value;
        $adicionar = 0;
      }
    }
  }

  // Adiciona o prato ao array do pedido caso não existir no pedido
  if ($dar_push == 1) {
    array_push($_SESSION['usuario']['pedido'], [$_POST['prato'], $_POST['quantidade'], $_POST['observacao']]);
  }

  header('location: restaurante.php?restaurante='.$_POST['restaurante'].'&redirect=1');
  exit;




 ?>
