<?php
  include 'topo.php';
  include 'entidades/Pedido.php';
  include 'entidades/Restaurante.php';

  $dar_nota = '';
  $cancelar_pedido = '';

  // Pega os pedidos abertos do usuário logado
  $pedidos = Pedido::consultar( 'id_usuario = '.$_SESSION['usuario']['id'], 'id_situacao');

  // Caso não ache nenhum pedido
  if (!$pedidos) {
    echo 'Não existem pedidos abertos';
    exit;
  } else {
          echo "<div class='container mt-2'>";
    foreach ($pedidos as $pedido) {

      // Pega o restaurante responsável pelo pedido
      $restaurante = Restaurante::consultar_restaurante( $pedido->id_restaurante );

      if ($pedido->id_situacao == 1) {
        $situacao = 'Aberto';
        $cor = 'fundo-pedido-aberto';
        $cancelar_pedido = "<a href='cancelar_pedido.php' class='btn btn-danger'>Cancelar pedido</a>";
      } elseif ($pedido->id_situacao == 2) {
        $situacao = 'Preparando';
        $cor = 'fundo-pedido-processando';
      } elseif ($pedido->id_situacao == 3) {
        $situacao = 'Finalizado';
        $cor = 'fundo-pedido-fechado';
      } elseif ($pedido->id_situacao == 4) {
        $situacao = 'Recusado';
        $cor = 'fundo-pedido-recusado';
      }

      echo '<div class="box-pedidos '.$cor.'">
              <p><b>ID do pedido:</b> '.$pedido->id.'</p>
              <p><b>Restaurante:</b> '.$restaurante->nome.'</p>
              <p><b>Situação do pedido:</b> '.$situacao.'</p>
              <p><b>Data do pedido:</b> '.$pedido->data_pedido.'</p>
              <br>
              <a href="detalhes-pedido-cliente.php?pedido='.$pedido->id.'" class="btn btn-primary">Visualizar detalhes</a>
              '.$dar_nota.'
            </div>';

            $dar_nota = '';
            $cancelar_pedido = '';
    }
      echo '<br><br>';
      echo "<a href='pag-inicial-adm.php' class='btn btn-primary'>Voltar a página inicial</a>";
      echo "</div>";
      echo '<br><br>';
  }
?>



<?php include 'rodape.php'; ?>
