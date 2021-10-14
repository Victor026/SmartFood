<?php
  include 'topo.php';
  $url = 'api-mensagem.php?id_origem='.$_SESSION['usuario']['id'].'&id_destino='.$_GET['id_destino'].'&id_pedido='.$_GET['pedido'];
 ?>

 <div class="container mt-4">
   <p>Você está falando com:</p>
   <h4>Restaurante Paulista</h4>
   <div class="chat">
     <p id="conversa" style="word-break: break-all;"></p>
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
           if (mensagens[i].id_origem == <?php echo $_SESSION['usuario']['id'];?>) {
             output += '<p style="float: left">'+mensagens[i].mensagem+'</p>';
           } else {
             output += '<p style="float: right">'+mensagens[i].mensagem+'</p>';
           }

         }

         document.getElementById('conversa').innerHTML = output;
       }
     }

     xhr.send();
   }

 </script>
 <?php
  include 'rodape.php';
  ?>
