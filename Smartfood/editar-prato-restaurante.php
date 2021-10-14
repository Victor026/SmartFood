<?php
  include 'topo.php';
  include 'entidades/Prato.php';

  $prato = Prato::consultar_prato($_GET['prato']);

?>

<div class="container mt-3">
  <form method="post" enctype="multipart/form-data" action="acao-editar-prato.php">
   	<h4>Editar prato</h4>
    <label for="nome">Selecione a imagem do prato:</label>
    <input type="file" name="fileToUpload" id="fileToUpload">
   	<div class="form-group mt-3">
      <label for="nome">Nome</label>
      <input type="text" name="nome" value="<?=$prato->nome?>">
   	</div>
   	<div class="form-group mt-3">
      <label for="descricao">Descrição</label>
      <textarea name="descricao" rows="4" cols="50">
        <?=$prato->descricao?>
      </textarea>
   	</div>
    <div class="form-group mt-3">
      <label for="preco">Preço</label>
      <input type="text" name="preco" value="<?=$prato->preco?>">
   	</div>
   	<div class="form-group mt-3">
   	 	<button type="submit" class="btn btn-primary">Editar</button>
      <a href="pag-inicial-res.php" class="btn btn-danger">Cancelar</a>
   	</div>

    <input type="hidden" name="prato" value="<?=$prato->id?>">

   </form>
</div>


<?php
  include 'rodape.php';
 ?>
