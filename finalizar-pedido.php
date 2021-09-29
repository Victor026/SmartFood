<?php
  include 'topo.php';
  include 'entidades/Pedido.php';
  include 'entidades/Prato.php';

  $saida_pratos = '';
  $preco_total = 0;

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

        $saida_pratos .= '<div class="prato-finalizacao">
                            <h4>'.$prato_atual->nome.'</h4>
                            <p>Quantidade: '.$value.'</p>
                            <p>Preço: R$ '.$preco.'</p>
                            <a class="btn btn-danger" style="color: white;">Remover</a>
                          </div>';

      }

    }
  }

  // Formata o preço total
  $preco_total_f  = number_format($preco_total, 2, ',', ' ');

 ?>

 <?=$saida_pratos?>
 <div class="container mt-3">
   <p>Preço total a pagar: <?=$preco_total_f?></p>
 </div>

 <div class="container">
    <a href="#" class="btn btn-primary mt-3 ml-3">Adicionar mais pratos</a>
    <a href="#" class="btn btn-success mt-3 ml-3">Finalizar</a>
    <a href="#" class="btn btn-danger mt-3 ml-3">Cancelar pedido</a>
 </div>


<?php
  include 'rodape.php';
 ?>
