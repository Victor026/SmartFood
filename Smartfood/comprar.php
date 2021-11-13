<?php

  include 'entidades/Prato.php';
  include 'topo.php';

  $preco_total = 0;

  // Dá loop nos pratos do pedido
  foreach ($_SESSION['usuario']['pedido'] as $prato) {

    // Verifica o id e a quantidade de cada prato
    foreach ($prato as $key => $value) {

      // Pega as informações do prato pelo id
      if ($key == 0) {
        $prato_atual = Prato::consultar_prato($value);
      }

      // Se a variável adicionar estiver = true adiciona a quantidade a já existente
      if ($key == 1) {

        // Formata o preço do prato
        $preco = number_format($prato_atual->preco * $value, 2, ',', ' ');
        $preco_total += $prato_atual->preco * $value;
        $quantidade = $value;

      }

      // Pega a observação do prato no pedido
      if ($key == 2) {
        $observacao = $value;
      }

    }
  }

  $nome = explode(" ",$_SESSION['usuario']['nome']);

  $solicitacao = [
      'referenceId' => microtime(true),
      'callbackUrl' => 'http://'.$_SERVER['HTTP_HOST'].'/notificacao.php',
      'value' => $preco_total,
      'buyer' => [
          'firstName' => $nome[0],
          'lastName' => $nome[count($nome)-1],
          'document' => '123.456.789-10',
          'email' => $_SESSION['usuario']['email'],
          'phone' => '+55 11 12345-6789'
      ]
  ];
  $picPayToken = '1c43c132-4cdb-45ce-9bd7-6ebcb019bc83';
  // inicializar o cURL
  $ch = curl_init();
  // fornecer a url de destino
  curl_setopt($ch, CURLOPT_URL, 'https://appws.picpay.com/ecommerce/public/payments');
  // passar o parâmetro para retornar a resposta
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  // fornecer os dados necessários para gerar o QR Code
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($solicitacao));
  // informar que iremos fazer uma requisição utilizando o método POST
  curl_setopt($ch, CURLOPT_POST, true);

  // enviar os headers obrigatórios
  $headers = [];
  $headers[] = 'Content-Type: application/json';
  $headers[] = 'X-Picpay-Token: ' . $picPayToken;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  // fazer a requisição
  $result = curl_exec($ch);
  // armazenar a resposta
  $resposta = json_decode($result);
  // abortar caso aconteça algum erro
  if (curl_errno($ch)) {
      die('Erro: ' . curl_error($ch));
  }
  // fechar a conexão
  curl_close($ch);
?>

<div class="container text-center mt-5">
  <h1>Pague com PicPay!</h1>
  <img src="<?= $resposta->qrcode->base64 ?>" alt="QR Code" class="mt-2">
</div>
<br>

<!-- Responsável por statu -->
<script type="text/javascript">

  pegarStatus();

  let intervalo1 = setInterval(() => pegarStatus(), 1000);

  function pegarStatus() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'status.php?referencia=<?php echo $resposta->referenceId; ?>', true);

    xhr.onload = function() {
      if (this.status == 200) {
        if (this.responseText == 'paid') {
          window.location.replace("http://localhost/Smartfood/acao-pagamento-confirmado.php");
        }



      }
    }

    xhr.send();
  }

</script>
<?php
  include 'rodape.php';
?>
