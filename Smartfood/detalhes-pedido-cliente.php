<?php
  include 'topo.php';
  include 'entidades/Pedido.php';
  include 'entidades/Prato.php';
  include 'entidades/Restaurante.php';
  include 'entidades/Prato_Pedido.php';

  // Saída dos pratos
  $saida_pratos = '';
  // Dependendo da situação do pedido aparece uma opção
  $entrar_em_contato = '';
  // Caso o pedido esteja sendo processado aparece "Finalizar pedido" ou "Recusar pedido"
  $cancelar_pedido = '';

  $dar_nota = '';

  // Pega o pedido
  $pedido = Pedido::consultar_pedido( $_GET['pedido'] );

  // Pega o restaurante responsável pelo pedido
  $restaurante = Restaurante::consultar_restaurante($pedido->id_restaurante);

  // Pega o registro do restaurante na tabela usuário
  $usuario_rest = Usuario::consultar_usuario($restaurante->email);

  // Verifica se o pedido existe
  if (!$pedido instanceof Pedido) {
    header('location:pedidos.php');
    exit;
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
    $situacao = 'Recusado';
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

  $entrar_em_contato = '<a href="chat.php?id_destino='.$usuario_rest->id.'&pedido='.$pedido->id.'" class="btn btn-success">Entrar em contato com o restaurante</a>';

  if ($pedido->id_situacao == 1) {
    // $cancelar_pedido = '<a href="cancelar-pedido.php?pedido='.$pedido->id.'" class="btn btn-danger">Cancelar pedido</a>';
  }

?>

  <div class="container mt-4">
    <h3>Pedido #<?=$pedido->id?></h3>
    <br>
    <p><b>Restaurante:</b> <?=$restaurante->nome?></p>
    <p><b>Data do pedido:</b> <?=$pedido->data_pedido?></p>
    <p><b>Situação do pedido:</b> <?=$situacao?></p>
    <br>
    <h4>Itens do pedido: </h4>
    <div class="">

    </div>
    <?=$saida_pratos?>
    <br>
    <?=$entrar_em_contato?>
    <?=$cancelar_pedido?>
    <br>
    <a href="pedidos.php" class="btn btn-primary mt-4">Voltar os pedidos</a>
    <br><br>
  </div>

<?php
  include 'rodape.php';
?>
