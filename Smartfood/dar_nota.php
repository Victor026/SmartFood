<?php
  include 'topo.php';
  include 'entidades/Pedido.php';
  include 'entidades/Restaurante.php';

  if (isset($_POST['enviar'])) {
    $pedido = Pedido::consultar_pedido( $_GET['pedido'] );
    $restaurante = Restaurante::consultar_restaurante( $pedido->id_restaurante );
    $restaurante->nota += $_POST['nota'];
    $restaurante->pedidos_nota += 1;
    $restaurante->atualizar();
    header('location:pag-inicial-adm.php');
    exit;
  }
?>

<div class="container mt-4">
  <form method="post">
   	<h4>Dê uma nota para o restaurante:</h4>
   	<div class="form-group mt-3">
   	 	<label for="campo1">Nota</label>
   	 	<input type="text" class="form-control" name="nota">
   	</div>
   	<div class="form-group mt-3">
   	 	<button type="submit" class="btn btn-success" name="enviar">Dar nota</button>
   	</div>
   </form>
</div>



<?php
  include 'rodape.php';
?>
