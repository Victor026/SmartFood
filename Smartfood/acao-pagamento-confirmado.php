<?php

  include 'topo.php';
  include 'entidades/Pedido.php';
  include 'entidades/Prato.php';
  include 'entidades/Prato_Pedido.php';

  // Cria o novo pedido
  $pedido = new Pedido;
  $pedido->id_usuario = $_SESSION['usuario']['id'];
  $pedido->data_pedido = date("Y-m-d H:i:s");
  $pedido->id_situacao = 1;
  $pedido->cadastrar();

  // O id do restaurante começa com 0
  $id_restaurante = 0;

  // Dá loop nos pratos do pedido
  foreach ($_SESSION['usuario']['pedido'] as $prato) {

    // Cria o registro do Prato x Pedido
    $prato_pedido = new Prato_Pedido;

    // Verifica o id de cada prato
    foreach ($prato as $key => $value) {

      // Pega as informações do prato pelo id
      if ($key == 0) {
        $prato_atual = Prato::consultar_prato($value);

        // Pega o ID do restaurante do prato
        $id_restaurante = $prato_atual->id_restaurante;
      }

      // Pega a quantidade do prato no $value e cria o registro Prato x Pedido
      if ($key == 1) {
        // Preenche os dados do prato do pedido
        $prato_pedido->qtd_prato = $value;
        $prato_pedido->id_prato = $prato_atual->id;
        $prato_pedido->id_pedido = $pedido->id;
      }

      if ($key == 2) {
        //Preenche o restante dos dados e cadastra o prato no pedido
        $prato_pedido->observacao = $value;
      }

    }

    // Cadastra o prato no pedido
    $prato_pedido->cadastrar();

  }

  $pedido->id_restaurante = $id_restaurante;
  $pedido->atualizar();

  $_SESSION['usuario']['pedido'] = array();

  header('location:pedidos.php');
  exit;

 ?>
