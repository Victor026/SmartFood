<?php
  include 'database/Database.php';
  include 'entidades/Mensagem.php';

  $date = date( 'Y-m-d H:i:s' );

  if ($_GET) {
    $mensagens = Mensagem::consultar( '( id_origem='.$_GET['id_origem'].' AND id_destino='.$_GET['id_destino'].' AND id_pedido = '.$_GET['id_pedido'].' )
                                   OR  ( id_origem='.$_GET['id_destino'].' AND id_destino='.$_GET['id_origem'].' AND id_pedido = '.$_GET['id_pedido'].' )' );

    $json_mensagens = json_encode($mensagens);
    echo $json_mensagens;
  }

  // A mensagem é enviada ao BDD
  if (isset($_POST['mensagem'])) {
    $mensagem = new Mensagem;
    $mensagem->id_pedido = $_POST['pedido'];
    $mensagem->id_origem = $_POST['origem'];
    $mensagem->id_destino = $_POST['destino'];
    $mensagem->data_mensagem = $date;
    $mensagem->mensagem = $_POST['mensagem'];
    $mensagem->cadastrar();
  }
