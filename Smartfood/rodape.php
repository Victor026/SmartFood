
<!-- Responsável por verificar mensagens novas -->
<script type="text/javascript">

  pegarMensagens();

  let intervalo = setInterval(() => pegarMensagens(), 900);

  function pegarMensagens() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'api-novas-mensagens.php?usuario=<?php echo $_SESSION['usuario']['id'];?>&data=<?php echo date( 'Y-m-d H:i:s' ) ?>', true);

    xhr.onload = function() {
      if (this.status == 200) {
        var novas_mensagens = JSON.parse(this.responseText);
        if (novas_mensagens.length > 0) {
          console.log(novas_mensagens[0].id_destino);
          document.getElementById('novas-mensagens').innerHTML = '<div class="novas-mensagens"><a href="chat.php?id_destino='+novas_mensagens[0].id_origem+'&pedido='+novas_mensagens[0].id_pedido+'" style="color: white; text-decoration: none;">Há novas mensagens!</a></div>';
        }
      }
    }

    xhr.send();
  }

</script>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="src/js/bootstrap.min.js"></script>

</body>
</html>
