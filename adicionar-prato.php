<?php
  include 'topo.php';
  include 'entidades/Prato.php';
  // Seleciona o prato através do ID
  $prato = Prato::consultar_prato($_GET['prato']);
  if (isset($_GET['pedido'])) {
    $pedido = $_GET['pedido'];
  }

 ?>

  <form method="post" class="mt-4 ml-4" action="acao-adicionar-prato.php">
   	<h5>Detalhes do pedido:</h4>
   	<div class="form-group mt-3">
      <h4><?=$prato->nome?></h4>
   	 	<label for="quantidade">Quantidade</label>
      <select name="quantidade" class="form-control" style="max-width: 4em;" id="quantidade">
        <option selected="selected" value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
   	</div>
   	<div class="form-group mt-3">
   	 	<button type="submit" class="btn btn-primary" name="adicionar">Adicionar prato</button>
      <a href="restaurante.php?restaurante=<?=$_GET['restaurante']?>" class="btn btn-danger">Cancelar</a>
   	</div>

      <input type="hidden" name="restaurante" value="<?=$_GET['restaurante']?>">
      <input type="hidden" name="prato" value="<?=$_GET['prato']?>">
      <input type="hidden" name="id_usuario" value="<?=$_SESSION['usuario']['id']?>">
      <?php if (isset($_GET['pedido'])) {
        echo '<input type="hidden" name="pedido" value="'.$pedido.'">';
      } ?>


   </form>

<?php
  include 'rodape.php';
 ?>
