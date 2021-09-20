
<?php
$page = 'dados';
include 'topo.php' ?>
<?php
$dados = '';
$id_usr = $_SESSION['usuario']['id'];
foreach ($_SESSION['usuario'] as $chave => $dado) {
  // Campos que não serão exibidos ao usuário
  if (
         ($_SESSION['usuario']['visibilidade'] == 'a' && $chave == 'nome_corretora')
      || $chave == 'atribuido_contatos'
      || $chave == 'visibilidade'
      || $chave == 'aceito'
      || $chave == 'ativo'
      || $chave == 'id'
      ) {
    continue;
  }
  $chave[0] = strtoupper($chave[0]);
  $chave = str_replace("_"," da ",$chave);
  $dados .= '<p class="fonte-grande mt-4"><strong>'.$chave.'</strong>: '.$dado.'<br></p>';
}
echo '<div class="container justify-content-center d-flex">
      <div class="metade-esquerda mt-4 bg-white p-4 d-pessoais">
        <h4>Seus dados:</h4>
      '.$dados.'
      <a href="editar-dados.php?id='.$id_usr.'" class="mt-1 btn btn-primary">Editar</a>
      </form>
      </div>
      </div>';
?>
<?php include 'rodape.php' ?>
