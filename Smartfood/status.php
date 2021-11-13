<?php

include 'database/Database.php';
include 'entidades/Pedido.php';
include 'entidades/Prato.php';
include 'entidades/Prato_Pedido.php';

// recebe o código de referência por GET
if (empty($_GET) && !isset($_GET['referencia'])) {
    // aborta caso não tenha passado o código
    die('Forneça a refência');
}
$picPayToken = '1c43c132-4cdb-45ce-9bd7-6ebcb019bc83';
// monta a url
$url = 'https://appws.picpay.com/ecommerce/public/payments/'.$_GET['referencia'].'/status';
// inicializa o cURL
$ch = curl_init();
// fornece a url de destino
curl_setopt($ch, CURLOPT_URL, $url);
// passa o parâmetro para retornar a resposta
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// envia os headers obrigatórios
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'X-Picpay-Token: ' . $picPayToken
]);
// faz a requisição
$result = curl_exec($ch);
// armazena a resposta
$resposta = json_decode($result);
echo $resposta->status;
// exibe o conteúdo da resposta

exit;
// aborta caso aconteça algum erro
if (curl_errno($ch)) {
    die('Error: ' . curl_error($ch));
}
// fecha a conexão
curl_close($ch);
?>
<!-- <?php if ($resposta->authorizationId) { ?>
    <br> e o código da autorização é <?= $resposta->authorizationId ?>.
    <br>
    <a href="cancelar.php?referencia=<?= $_GET['referencia'] ?>&autorizacao=<?= $resposta->authorizationId?>">Cancelar</a>
<?php } else {?>
    <br>
    <a href="cancelar.php?referencia=<?= $_GET['referencia'] ?>">Cancelar</a>
<?php } ?> --> -->
