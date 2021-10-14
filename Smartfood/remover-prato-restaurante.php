<?php
 include 'topo.php';
 include 'entidades/Prato.php';

 $prato = Prato::consultar_prato($_GET['prato']);


 if (isset($_POST['excluir'])) {
   $prato->excluido = 's';
   $prato->atualizar();
   header('location:pag-inicial-res.php');
   exit;
 }

?>

  <div class="container mt-4">
    <form method="post">
     	<h4>Excluir prato</h4>
     	<div class="form-group mt-3">
        <p>Deseja realmente excluir o prato <?=$prato->nome?> ?</p>
     	</div>
      <a href="pag-inicial-res.php">
        <button type="button" class="btn btn-success">Cancelar</button>
      </a>
      <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
     </form>
  </div>

 <?php
  include 'rodape.php';
  ?>
