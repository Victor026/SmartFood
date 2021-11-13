<?php
  include 'topo.php';
  include 'entidades/Usuario.php';
  $usuario = Usuario::consultar_usuario_id($_GET['id_destino']);
  $url = 'api-mensagem.php?id_origem='.$_SESSION['usuario']['id'].'&id_destino='.$_GET['id_destino'].'&id_pedido='.$_GET['pedido'];
 ?>

 <div class="container mt-4">
   <p>Você está falando com:</p>
   <h4><?=$usuario->nome?></h4>
   <div class="chat">
     <div id="conversa" style="word-break: break-all; color: white;"></div>
   </div>

   <textarea id="mensagem"  class="box-mensagem mt-3" rows="8" cols="80" placeholder="Insira uma mensagem..."></textarea>
   <br>


	 <button type="button" class="btn btn-primary mt-3" id="enviar">Enviar</button>

 </div>

 <!-- Responsável pela lógica do chat -->
 <script type="text/javascript">

   pegarMensagens();

   let myInterval = setInterval(() => pegarMensagens(), 900);

   document.getElementById('enviar').addEventListener('click', () => {

     var mensagem = document.getElementById('mensagem').value;

      var xhr = new XMLHttpRequest();
      xhr.open("POST", 'api-mensagem.php', true);
      // Envia a informação do cabeçalho junto com a requisição.
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = () => {
          console.log("done");
        };
      xhr.onreadystatechange = function() { // Chama a função quando o estado mudar.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
              // Requisição finalizada. Faça o processamento aqui.
          }
      }
      xhr.send("origem=<?=$_SESSION['usuario']['id']?>&destino=<?=$_GET['id_destino']?>&pedido=<?=$_GET['pedido']?>&mensagem="+mensagem);

      document.getElementById('mensagem').value = '';
   });

   function pegarMensagens() {
     var xhr = new XMLHttpRequest();
     xhr.open('GET', '<?php echo $url; ?>', true);

     xhr.onload = function() {
       if (this.status == 200) {
         var mensagens = JSON.parse(this.responseText);
         console.log(mensagens);
         var output = '';

         for (var i = 0; i < mensagens.length; i++) {
           time = mensagens[i].data_mensagem.substring(mensagens[i].data_mensagem.length - 8);
           if (mensagens[i].id_origem == <?php echo $_SESSION['usuario']['id'];?>) {
             output += '<div class="azul-chat div-mensagem-direita"><p>'+mensagens[i].mensagem+ '<br><small style="color: #c9c0bb;">'+time+'</small></p></div>';
           } else {
             output += '<div class="azul-chat div-mensagem-esquerda"><p class="texto-left verde-chat">'+mensagens[i].mensagem+'<br><small style="color: #c9c0bb;">'+time+'</small></p></div>';
           }
           output += '<br>'
         }

         document.getElementById('conversa').innerHTML = output;
         document.querySelector("#conversa").scrollTop = document.querySelector("#conversa").scrollHeight;
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
