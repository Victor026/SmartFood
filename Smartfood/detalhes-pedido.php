<?php
  include 'topo.php';
  include 'entidades/Pedido.php';
  include 'entidades/Prato.php';
  include 'entidades/Usuario.php';
  include 'entidades/Prato_Pedido.php';

  // Saída dos pratos
  $saida_pratos = '';
  // Dependendo da situação do pedido aparece uma opção
  $mudar_situacao = '';
  // Caso o pedido esteja sendo processado aparece "Finalizar pedido" ou "Recusar pedido"
  $finalizar_pedido = '';

  // Pega o pedido
  $pedido = Pedido::consultar_pedido( $_GET['pedido'] );

  // Verifica se o pedido existe
  if (!$pedido instanceof Pedido) {
    header('location:restaurante-pedidos.php');
    exit;
  }

  // Pega o usuário que fez o pedido
  $usuario = Usuario::consultar_usuario_id( $pedido->id_usuario );

  // Pega os pratos do pedido
  $pratos_pedido = Prato_Pedido::consultar( 'id_pedido = '.$pedido->id );

  // Adiciona os pratos à saída
  foreach ($pratos_pedido as $prato_pedido) {
    $prato = Prato::consultar_prato( $prato_pedido->id_prato );
    $saida_pratos .= '<div class="prato_detalhes">
                        <p><b>Nome do prato:</b> '.$prato->nome.'</p>
                        <p><b>Quantidade:</b> '.$prato_pedido->qtd_prato.'</p>
                        <p><b>Observação:</b> '.$prato_pedido->observacao.'</p>
                      </div>
                      <br>';
  }

  if ($pedido->id_situacao == 1) {
    $mudar_situacao = '<a href="preparar-pedido.php?pedido='.$pedido->id.'" class="btn btn-primary">Preparar pedido</a>';
    $finalizar_pedido = '<a href="recusar-pedido.php?pedido='.$pedido->id.'" class="btn btn-danger">Recusar pedido</a>';
  } elseif ($pedido->id_situacao == 2) {
    $mudar_situacao = '<a href="restaurante-pedido-pronto.php?pedido='.$pedido->id.'" class="btn btn-danger">Pedido pronto</a>';
  } elseif ($pedido->id_situacao == 3) {
    $mudar_situacao = '<a href="restaurante-finalizar-pedido.php?pedido='.$pedido->id.'" class="btn btn-danger">Finalizar pedido</a>';
  }

  $situacao = '';
  if ($pedido->id_situacao == 1) {
    $situacao = 'Aberto';
  } elseif ($pedido->id_situacao == 2) {
    $situacao = 'Preparando';
  } elseif ($pedido->id_situacao == 3) {
    $situacao = 'Esperando retirada';
  } elseif ($pedido->id_situacao == 4) {
    $situacao = 'Finalizado';
  } elseif ($pedido->id_situacao == 5) {
    $situacao = 'Recusado';
  }
?>

  <div class="container mt-4">
    <h3>Pedido #<?=$pedido->id?></h3>
    <br>
    <p><b>Nome do cliente:</b> <?=$usuario->nome?></p>
    <p><b>Data do pedido:</b> <?=$pedido->data_pedido?></p>
    <p><b>Situação do pedido:</b> <?=$situacao?></p>
    <br>
    <h4>Itens do pedido: </h4>
    <div class="">

    </div>
    <?=$saida_pratos?>

    <?=$mudar_situacao?> <br><br>
    <a href="chat.php?id_destino=<?=$usuario->id?>&pedido=<?=$pedido->id?>" class="btn btn-success">Entrar em contato com o cliente</a>
    <!-- <a href="chat.php?id_destino='.$usuario->id.'&pedido='.$pedido->id.'" class="btn btn-success">Entrar em contato com o restaurante</a> -->
    <br><br>
    <?=$finalizar_pedido?>

  </div>

<?php
  include 'rodape.php';
?>
