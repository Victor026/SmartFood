<?php
  $page = 'home';
  include 'topo.php';

  // Classe do Restaurante
  include 'entidades/Restaurante.php';
  // Classe da paginação
  include 'database/Pagination.php';
  // Classe do Prato
  include 'entidades/Prato.php';
  //Classe do Pedido
  include 'entidades/Pedido.php';

  $saida_pratos = '';
  $pedidos_abertos = '';
  $pedidos = '';

  Login::requireLogin();

  $restaurante = Restaurante::consultar_restaurante_email( $_SESSION['usuario']['email'] );
  $pedidos = Pedido::consultar( 'id_restaurante ='.$restaurante->id.' AND ( id_situacao = 1 )' );
  // Se houver pedidos abertos aparece aviso
  if ($pedidos) {
  }

  echo '<a href="restaurante-pedidos.php" class="btn btn-primary" id="pedidos-abertos" style="width: 100%; border-radius: 0;">Visualizar pedidos</a>';
  echo '<img src="src/img/fotos_restaurantes/restaurante-'.$restaurante->id.'.jpg" alt="" class="img-topo-restaurante">';

  $pratos = Prato::consultar( 'id_restaurante = '.$restaurante->id );

  foreach ($pratos as $prato) {
    // Não mostra os pratos excluídos
    if ($prato->excluido == null) {
      $saida_pratos .= '<div class="prato-finalizacao">
                          <h4>'.$prato->nome.'</h4>
                          <img src="src/img/fotos_pratos/prato-'.$prato->id.'.jpg" alt="" class="img-prato">
                          <p>Descrição: '.$prato->descricao.'</p>
                          <p>Preço: '.number_format($prato->preco, 2, ',', ' ').'</p>
                          <a href="remover-prato-restaurante.php?prato='.$prato->id.'" class="btn btn-danger mt-3" style="color: white;" name="excluir">Excluir</a>
                          <a href="editar-prato-restaurante.php?prato='.$prato->id.'" class="btn btn-primary mt-3" style="color: white;">Editar</a>
                        </div>';
    }
  }

?>
<div class="container">
  <?=$saida_pratos?>
  <a <?php echo 'href="registrar-prato.php?restaurante='.$restaurante->id.'"'; ?> class="btn btn-success mt-2 mb-2">Adicionar pratos</a>
</div>

<script type="text/javascript">

  let pedidosAbertos = document.querySelector('#pedidos-abertos');

  pegarPedidosAbertos();

  let interval = setInterval(() => pegarPedidosAbertos(), 900);

  function pegarPedidosAbertos() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'api-pedidos.php?restaurante=<?=$restaurante->id?>', true);
    xhr.onload = function() {
      if (this.status == 200) {
        if (this.responseText != '[]') {
            var pedidos = JSON.parse(this.responseText);
        }
        console.log(pedidos);
      }
      if (pedidos == null) {
        pedidosAbertos.style.display = "none";
      } else {
        pedidosAbertos.style.display = "block";
      }
    };
    xhr.send();
  }
</script>

<?php include 'rodape.php'; ?>
