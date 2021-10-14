<?php
  include 'topo.php';

  // Dá loop nos pratos do pedido
  foreach ($_SESSION['usuario']['pedido'] as $chave => $prato) {

    // Verifica o id e a quantidade de cada prato
    foreach ($prato as $key => $value) {

      // Caso seja o prato a ser removido
      if ($key == 0) {
        if ($value == $_GET['prato']) {
          unset($_SESSION['usuario']['pedido'][$chave]);

          // Caso ainda tenha mais pratos mostra-os senão
          // redireciona pra página inicial
          if (!empty($_SESSION['usuario']['pedido'])) {
            header('location:finalizar-pedido.php');
            exit;
          } else {
            header('location:pag-inicial-adm.php');
            exit;
          }
        }
      }

    }
  }
 ?>
