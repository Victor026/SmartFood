<?php
  include 'topo.php';
  include 'entidades/Pedido.php';
  include 'entidades/Prato_Pedido.php';

  // Pega o pedido
  $pedido = Pedido::consultar_pedido($_GET['pedido']);

  // Validação do pedido
  if (!$pedido instanceof Pedido) {
    header('location:pag-inicial-res.php');
    exit;
  }

  // Caso seja selecionado a opção "cancelar pedido"
  if (isset($_POST['cancelar'])) {

    // Pega todos os pratos do pedido na tabela Prato_Pedido
    $pratos_pedido = Prato_Pedido::consultar( 'id_pedido = '.$pedido->id );

    // Deleta os registros do Prato_Pedido
    foreach ($pratos_pedido as $prato_pedido) {
      $prato_pedido->excluir();
    }

    // Deleta o pedido
    $pedido->excluir();
    header('location:pedidos.php');
    exit;
  }

 ?>

 <div class="container mt-3">
   <form method="post">
    	<h4>Cancelar pedido</h4>
    	<div class="form-group mt-3">
    	 	<p>Tem certeza que deseja cancelar o pedido?</p>
    	</div>
    	<div class="form-group mt-3">
    	 	<button type="submit" class="btn btn-danger" name="cancelar">Cancelar</button>
        <a href="detalhes-pedido-cliente.php?pedido="<?=$pedido->id?> class="btn btn-success">Continuar com o pedido</a>

    	</div>
    </form>
 </div>

<?php
  include 'rodape.php';
 ?>
