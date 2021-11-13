<?php
  include 'topo.php';
  include 'entidades/Pedido.php';
  include 'entidades/Restaurante.php';

  $pedidos_abertos = '';
  $cor = '';

  $restaurante = Restaurante::consultar_restaurante_email( $_SESSION['usuario']['email'] );

  $pedidos = Pedido::consultar( 'id_restaurante ='.$restaurante->id, 'id_situacao' );

  echo "<div class='container mt-2'>";
    foreach ($pedidos as $pedido) {

      // Pega os dados do usuário que fez o pedido
      $usuario = Usuario::consultar_usuario_id($pedido->id_usuario);
      // Descrição da situação
      $situacao = '';
      if ($pedido->id_situacao == 1) {
        $situacao = 'Aberto';
        $cor = 'fundo-pedido-aberto';
      } elseif ($pedido->id_situacao == 2) {
        $situacao = 'Preparando';
        $cor = 'fundo-pedido-processando';
      } elseif ($pedido->id_situacao == 3) {
        $situacao = 'Esperando retirada';
        $cor = 'fundo-pedido-esperando';
      } elseif ($pedido->id_situacao == 4) {
        $situacao = 'Finalizado';
        $cor = 'fundo-pedido-fechado';
      } elseif ($pedido->id_situacao == 5) {
        $situacao = 'Recusado';
        $cor = 'fundo-pedido-recusado';
      }

      echo '<div class="box-pedidos '.$cor.'">
              <p><b>ID do pedido:</b> '.$pedido->id.'</p>
              <p><b>Data do pedido:</b> '.$pedido->data_pedido.'</p>
              <p><b>Cliente:</b> '.$usuario->nome.'</p>
              <p><b>Situação do pedido:</b> '.$situacao.'</p>
              <br>
              <a href="detalhes-pedido.php?pedido='.$pedido->id.'" class="btn btn-primary">Visualizar detalhes</a>
            </div>';
    }
  echo "</div>"

 ?>


<?php
  include 'rodape.php';
 ?>
