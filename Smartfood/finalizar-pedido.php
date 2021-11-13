<?php
  include 'topo.php';
  include 'entidades/Pedido.php';
  include 'entidades/Prato.php';

  $saida_pratos = '';
  $preco_total = 0;
  $quantidade = 0;
  $observacao = 0;

  // Caso não tenha nenhum pedido voltar pra tela inicial
  if (!isset($_SESSION['usuario']['pedido'])) {
    header('location:pag-inicial-adm.php');
  }

  // Dá loop nos pratos do pedido
  foreach ($_SESSION['usuario']['pedido'] as $prato) {

    // Verifica o id e a quantidade de cada prato
    foreach ($prato as $key => $value) {

      // Pega as informações do prato pelo id
      if ($key == 0) {
        $prato_atual = Prato::consultar_prato($value);
      }

      // Se a variável adicionar estiver = true adiciona a quantidade a já existente
      if ($key == 1) {

        // Formata o preço do prato
        $preco = number_format($prato_atual->preco * $value, 2, ',', ' ');
        $preco_total += $prato_atual->preco * $value;
        $quantidade = $value;

      }

      // Pega a observação do prato no pedido
      if ($key == 2) {
        $observacao = $value;
      }

    }

    $saida_pratos .= '<div class="prato-finalizacao">
                        <h4>'.$prato_atual->nome.'</h4>
                        <p>Quantidade: '.$quantidade.'</p>
                        <p>Observação: '.$observacao.'</p>
                        <p>Preço: R$ '.$preco.'</p>
                        <a href="remover-prato-pedido.php?prato='.$prato_atual->id.'" class="btn btn-danger" style="color: white;">Remover</a>
                      </div>';

    $observacao = '';
  }

  $restaurante = $prato_atual->id_restaurante;

  // Formata o preço do prato
  $preco_total_f  = number_format($preco_total, 2, ',', ' ');

 ?>


 <div class="container mt-3">
   <?=$saida_pratos?>
   <br>
   <p>Preço total a pagar: <?=$preco_total_f?></p>
 </div>

 <div class="container">
   <form method="post" action="acao-finalizar-pedido.php">
      <button type="submit" name="adicionar" class="btn btn-primary">Adicionar mais pratos</button>
      <button type="submit" name="finalizar" class="btn btn-success">Finalizar</button>
      <button type="submit" name="cancelar" class="btn btn-danger">Cancelar pedido</button>

      <input type="hidden" name="restaurante" value="<?=$restaurante?>">
   </form>
  </div>


<?php
  include 'rodape.php';
 ?>
