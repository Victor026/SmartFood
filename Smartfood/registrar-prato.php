<?php include 'topo.php'; 

$erro = '';
if(isset($_GET['erro'])) {
	$erro = '<div class="alert alert-danger">O preço do prato deve ser positivo</div>';
}
?>
<div class="container mt-3">
  <form method="post" action="acao-registrar-prato.php" enctype="multipart/form-data">
   	<h4>Cadastro do prato</h4>
    <label for="nome">Selecione a imagem do prato:</label>
    <input type="file" name="fileToUpload" id="fileToUpload">
   	<div class="form-group mt-3">
   	 	<label for="nome">Nome</label>
   	 	<input type="text" class="form-control" name="nome" placeholder="Insira o nome do prato...">
   	</div>
   	<div class="form-group mt-3">
   	 	<label for="descricao">Descrição</label>
   	 	<input type="text" class="form-control" name="descricao" placeholder="Insira a descrição do prato...">
   	</div>
    <div class="form-group mt-3">
   	 	<label for="preco">Preço</label>
   	 	<input type="text" class="form-control" name="preco" placeholder="Insira o preço do prato...">
   	</div>
	<?=$erro?>
   	<div class="form-group mt-3">
   	 	<button type="submit" class="btn btn-success">Cadastar</button>
   	 	<a href="pag-inicial-res.php" class="btn btn-danger">Cancelar</a>
   	</div>

    <input type="hidden" name="restaurante" value="<?=$_GET['restaurante']?>">

   </form>
</div>

<?php include 'rodape.php'; ?>
