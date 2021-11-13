<?php
  include 'database/Database.php';
  include 'entidades/Pedido.php';

  $pedidos = Pedido::consultar("id_situacao = 1 AND id_restaurante = ".$_GET["restaurante"] );

  $json_pedidos = json_encode($pedidos);
  echo $json_pedidos;
