<?php
  include 'topo.php';
  include 'entidades/Restaurante.php';
  include 'entidades/Prato.php';

  $restaurante = Restaurante::consultar_restaurante($_GET['restaurante']);
  $pratos = Prato::consultar('id_restaurante = '.$_GET['restaurante']);

  $alertaPedido = '';

  //Lógica para as mensagens dos redirecionamentos
    if (isset($_GET['redirect']) and $_GET['redirect'] == 1) {
      $alertaPedido='<div class="prato-adicionado esconder"> Prato adicionado ao carrinho! </div>';
    }

  // Verifica se já tem algum pedido aberto
  $pedido = '';
  if(isset($_GET['pedido'])) {
    $pedido = $_GET['pedido'];
  }

  echo $alertaPedido;

  echo '<img src="src/img/fotos_restaurantes/restaurante-'.$restaurante->id.'.jpg" alt="" class="img-topo-restaurante">
  <div class="container">
    <br>
    <h3>'.$restaurante->nome.'</h3>
    <br>
    <p>'.$restaurante->descricao.'</p>
    <a class="btn btn-primary" style="color: white;" href="pag-inicial-adm.php">Ver outros restaurantes</a>
  </div>';

  foreach ($pratos as $prato) {

  // Formata o preço do prato
  $preco = number_format($prato->preco, 2, ',', ' ');

  echo '<div class="prato">
  <img src="src/img/fotos_pratos/prato-'.$prato->id.'.jpg" alt="" class="img-prato">
  <br><br>
  <h4>'.$prato->nome.'</h4>
  <br>
  <p>'.$prato->descricao.'</p>
  <div class="preco">Preço: '.$preco.'</div>
  <br>
  <div class="avaliacao">Avaliação: '.$prato->avaliacao.'</div>
  <a href="adicionar-prato.php?prato='.$prato->id.'&restaurante='.$restaurante->id.'&pedido='.$pedido.'" class="pedir-prato">Adicionar prato</a>
</div>';
}

?>





<?php
include 'rodape.php';
?>
