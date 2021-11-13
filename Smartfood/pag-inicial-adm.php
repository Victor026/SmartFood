<?php
$page = 'home';
include 'topo.php';

// Classe dos restaurantes
include 'entidades/Restaurante.php';
// Classe da paginação
include 'database/Pagination.php';

Login::requireLogin();

$where_restaurantes = '';

if (isset($_GET['pagina_restaurantes'])) {
  $pagina_restaurantes   = $_GET['pagina_restaurantes'];
} else {
  $pagina_restaurantes = 1;
}

// Quantidade de restaurantes retornados
// $quantidaderestaurantes   = Restaurante::consultar_quantidade($where_restaurantes);
// $paginacao_restaurantes   = new Pagination($quantidaderestaurantes, $pagina_restaurantes, 7);
// $p_atual_restaurantes     = $paginacao_restaurantes->currentPage;

$dados = '';

// Seleciona os restaurantes de acordo com os filtros
$restaurantes = restaurante::consultar($where_restaurantes,null);
// $restaurantes = restaurante::consultar($where_restaurantes,null,$paginacao_restaurantes->getLimit());

unset($_SESSION['usuario']['atribuido_restaurantes']);
unset($_SESSION['usuario']['aceito']);
$saida_restaurantes = '';

foreach ($restaurantes as $restaurante) {
  $resp = '';
  $nota = '';

  if ($restaurante->pedidos_nota > 2) {
    $nota = '<p>Nota: '.round($restaurante->nota / $restaurante->pedidos_nota, 1).' ( '.$restaurante->pedidos_nota.' )</p>';
  } else {
    $nota = '<h5><span class="badge badge-secondary">Novo</span></h5>';
  }

// Saída da lista de restaurantes
/** NOVO LAYOUT **/
  $saida_restaurantes .= '
  <div class="restaurante">
    <img src="src/img/fotos_restaurantes/restaurante-'.$restaurante->id.'.jpg" alt="" class="img-restaurante">
    <h3 class="h3-restaurante">'.$restaurante->nome.'</h3>
    <p>'.$restaurante->descricao.'</p>
    <p>Horário de funcionamento: 10:00 - 18:00</p>
    '.$nota.'
    <a class="btn btn-primary" href="restaurante.php?restaurante='.$restaurante->id.'">Visualizar</a>
  </div>';

}
// Caso não retorne nenhum restaurante
if (!$saida_restaurantes) {
  $saida_restaurantes = '<button class="accordion" disabled>Não foram encontrados resultados</button>';
}

// Pega a página atual dos restaurantes
// $saida_paginacao_restaurantes = '';
// $paginas_restaurante = $paginacao_restaurantes->getPages();
// foreach ($paginas_restaurante as $key => $pagina) {
//   if ($pagina['atual'] != '') {
//     $p_atual_restaurantes = $pagina['atual'];
//     $p_atual_restaurantes = (int) $p_atual_restaurantes;
//   }
// }
// Coloca todos os filtros para qualquer página selecionada
$url_paginacao = '';

// Paginação restaurantes
// foreach ($paginas_restaurante as $key => $pagina) {
//   $saida_paginacao_restaurantes .= '';
// }

?>
  </div>
<!-- <div class="container">
    <?=$enviarestaurante?>
  </div>
 -->
  </div>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <h2 class="mb-4" style="font-weight: 900;">Restaurantes:</h2>
        <?=$saida_restaurantes?>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 mt-2">
        <!-- <?=$saida_paginacao_restaurantes?> -->
      </div>
    </div>


  </div>

</section>

<?php include 'rodape.php'; ?>
