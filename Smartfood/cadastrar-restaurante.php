<?php
    include 'topo.php';
    include 'entidades/Restaurante.php';
    $alertaCadastroRestaurante = '';

	if( $_POST ) {

		$alertaCadastroRestaurante = '';

        $restaurante = Restaurante::consultar_restaurante($_POST['email']);
        if( $restaurante instanceof Restaurante ) {
            $alertaCadastroRestaurante = $alertaCadastroRestaurante . '<div class="alert alert-danger mt-2"> Email já existente! Por favor selecione outro </div>';
        }
		
		$nome = test_input($_POST["nome"]);
		if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]*$/",$nome)) {
		  $alertaCadastroRestaurante = $alertaCadastroRestaurante . '<div class="alert alert-danger mt-2"> Nome: Somente letras e espaço em branco são permitidos. </div>';
		}
		
		$telefone = test_input($_POST["telefone"]);
		if (!preg_match("/^\({0,1}[1-9]{2}\){0,1}[0-9]{5}-{0,1}[0-9]{4}$/",$telefone)) {
		  $alertaCadastroRestaurante = $alertaCadastroRestaurante . '<div class="alert alert-danger mt-2"> Telefone: Formato incorreto.</div>';
		}
		
		$cnpj = test_input($_POST["cnpj"]);
		if (!preg_match("/^[0-9]{2}\.{0,1}[0-9]{3}\.{0,1}[0-9]{3}\/{0,1}[0-9]{4}-{0,1}[0-9]{2}$/",$cnpj)) {
			$alertaCadastroRestaurante = $alertaCadastroRestaurante . '<div class="alert alert-danger mt-2"> CNPJ: Inválido.</div>';
		}
		
		$estado = test_input($_POST["estado"]);
		if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]*$/",$estado)) {
		  $alertaCadastroRestaurante = $alertaCadastroRestaurante . '<div class="alert alert-danger mt-2"> Estado: Somente letras e espaço em branco são permitidos. </div>';
		}
		
		$cidade = test_input($_POST["cidade"]);
		if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]*$/",$cidade)) {
		  $alertaCadastroRestaurante = $alertaCadastroRestaurante . '<div class="alert alert-danger mt-2"> Cidade: Somente letras e espaço em branco são permitidos. </div>';
		}
		
		$email = test_input($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $alertaCadastroRestaurante =  $alertaCadastroRestaurante . '<div class="alert alert-danger mt-2"> Email: Formato incorreto.</div>';
		}
		
		$numero = test_input($_POST["numero"]);
		if (!filter_var($numero, FILTER_VALIDATE_INT)) {
		  $alertaCadastroRestaurante =  $alertaCadastroRestaurante . '<div class="alert alert-danger mt-2"> Número: Deve ser um inteiro.</div>';
		}

        // Cadastro na tabela restaurante
        $novo_restaurante = new Restaurante;
        $novo_restaurante->nome = $_POST['nome'];
        $novo_restaurante->cnpj = $_POST['cnpj'];
        $novo_restaurante->estado = $_POST['estado'];
        $novo_restaurante->cidade = $_POST['cidade'];
        $novo_restaurante->rua = $_POST['rua'];
        $novo_restaurante->numero = $_POST['numero'];
        $novo_restaurante->telefone = $_POST['telefone'];
        $novo_restaurante->email = $_POST['email'];
        $novo_restaurante->descricao = $_POST['descricao'];
        
	
        if ( ! $alertaCadastroRestaurante ) {
			$novo_restaurante->cadastrar();
			header("location:index.php?redirect=2");
		} 

        // Cadastro na tabela usuário
        $novo_usuario = new Usuario;
        $novo_usuario->nome = $_POST['nome'];
        $novo_usuario->telefone = $_POST['telefone'];
        $novo_usuario->email = $_POST['email'];
        $novo_usuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $novo_usuario->acesso = 'r';

		if ( ! $alertaCadastroRestaurante ) {
			$novo_usuario->cadastrar();
			
			
			$target_dir = "src/img/fotos_restaurantes/";
			$target_file = $target_dir . 'restaurante-'.$novo_restaurante->id.'.jpg';
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			  if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			  } else {
				echo "File is not an image.";
				$uploadOk = 0;
			  }
			}

			// Check if file already exists
			if (file_exists($target_file)) {
			  echo "Sorry, file already exists.";
			  $uploadOk = 0;
			}

			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 90000000000000) {
			  echo "Sorry, your file is too large.";
			  $uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			  $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			  echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
			  } else {
				echo "Sorry, there was an error uploading your file.";
			  }
			}

			header("location:index.php?redirect=2");
			exit;
		} 

    }
	
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>

<script type="text/javascript">
	function formatar_mascara(src, mascara) {
	 var campo = src.value.length;
	 var saida = mascara.substring(1,2);
		 var texto = mascara.substring(campo);
		 if(texto.substring(0,1) != saida) {
		 src.value += texto.substring(0,1);
		 }
	}
</script>

<section class = "sec-formulario">
    <form method="post" class="formulario-login formulario mt-4" enctype="multipart/form-data">
      <h3>Cadastrar restaurante</h3>
        <label for="nome">Selecione a imagem do restaurante:</label>
		    <input type="file" name="fileToUpload" id="fileToUpload">
        <label for="nome">Nome do restaurante</label>
        <input type="text" placeholder="Insira o nome do restaurante" name="nome" required>
        <label for="telefone">Telefone do restaurante</label>
        <input type="text" placeholder="Insira o telefone do restaurante" name="telefone" onkeypress="formatar_mascara(this,'(##)#####-####')"  maxlength="14" required>
        <label for="cnpj">CNPJ do restaurante</label>
        <input type="text" placeholder="Insira o cnpj do restaurante" name="cnpj" onkeypress="formatar_mascara(this,'##.###.###/####-##')" maxlength="18"required>
        <label for="estado">Estado</label>
        <input type="text" placeholder="Insira o estado do restaurante" name="estado" required>
        <label for="cidade">Cidade</label>
        <input type="text" placeholder="Insira a cidade do restaurante" name="cidade" required>
        <label for="rua">Rua</label>
        <input type="text" placeholder="Insira a rua do restaurante" name="rua" required>
        <label for="numero">Número</label>
        <input type="text" placeholder="Insira o número do restaurante" name="numero" required>
        <label for="descricao">Descrição</label>
        <input type="text" placeholder="Insira a descrição do restaurante" name="descricao" required>
        <label for="email">E-mail</label>
        <input type="text" placeholder="Insira o email do restaurante" name="email" required>
        <label for="senha">Senha</label>
        <input type="password" placeholder="Insira a senha..." name="senha" required>
        <button type="submit" class="btn btn-primary mt-2">Cadastrar</button>
        <p><?=$alertaCadastroRestaurante?></p>
    </form>
</section>
  <section class = "sec-formulario">
    <a href="index.php" class="btn btn-danger mt-4">Voltar para página inicial</a>
  </section>

  <br><br>


<?php
    include 'rodape.php';
?>
