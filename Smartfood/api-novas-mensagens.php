<?php
date_default_timezone_set('America/Sao_Paulo');
include 'database/Database.php';
include 'entidades/Mensagem.php';

if ($_GET) {
  $mensagens = Mensagem::consultar( 'data_mensagem > "'.$_GET['data'].'"' );
  $json_mensagens = json_encode($mensagens);
  echo $json_mensagens;
}

?>
