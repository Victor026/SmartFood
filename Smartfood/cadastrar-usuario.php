<?php
    include 'topo.php';
    include 'entidades/Usuario.php';
    
	$alertaCadastro = '';
	
	if( $_POST && ! $alertaCadastro) {

		$alertaCadastro = '';

        $usuario = Usuario::consultar_usuario($_POST['email']);
        if( $usuario instanceof Usuario ) {
            $alertaCadastro = $alertaCadastro . '<div class="alert alert-danger mt-2"> Email já existente! Por favor selecione outro </div>';
        }
		
		$nome = test_input($_POST["nome"]);
		if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]*$/",$nome)) {
		  $alertaCadastro = $alertaCadastro . '<div class="alert alert-danger mt-2"> Nome: Somente letras e espaço em branco são permitidos. </div>';
		}
		
		$telefone = test_input($_POST["telefone"]);
		if (!preg_match("/^\({0,1}[1-9]{2}\){0,1}[0-9]{5}-{0,1}[0-9]{4}$/",$telefone)) {
		  $alertaCadastro = $alertaCadastro . '<div class="alert alert-danger mt-2"> Telefone: Formato incorreto.</div>';
		}
		
		$email = test_input($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $alertaCadastro =  $alertaCadastro . '<div class="alert alert-danger mt-2"> Email: Formato incorreto.</div>';
		}
		
		$cpf = test_input($_POST["cpf"]);
		if (!preg_match("/^[0-9]{3}\.{0,1}[0-9]{3}\.{0,1}[0-9]{3}\.{0,1}-{0,1}[0-9]{2}$/",$cpf)) {
			$alertaCadastro = $alertaCadastro . '<div class="alert alert-danger mt-2"> CPF: Inválido.</div>';
		}
		
        $novo_usuario = new Usuario;
        $novo_usuario->nome = $_POST['nome'];
        $novo_usuario->telefone = $_POST['telefone'];
        $novo_usuario->email = $_POST['email'];
		$novo_usuario->cpf = $_POST['cpf'];
        $novo_usuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $novo_usuario->acesso = 'u';
        
        if ( ! $alertaCadastro ) {
			$novo_usuario->cadastrar();
			header("location:index.php?redirect=1");
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
    <form method="post" class="formulario-login formulario mt-4">
        <label for="nome">Nome do usuário</label>
        <input type="text" placeholder="Insira o nome do usuário" name="nome" required>
        <label for="cpf">CPF do usuário</label>
        <input type="text" placeholder="Insira o cpf do usuário" name="cpf" onkeypress="formatar_mascara(this,'###.###.###-##')" maxlength="14" required>
        <label for="nome">Telefone do usuário</label>
        <input type="text" placeholder="Insira o telefone do usuário" name="telefone" onkeypress="formatar_mascara(this,'(##)#####-####')"  maxlength="14" required>
        <label for="email">E-mail</label>
        <input type="text" placeholder="Insira o email do usuário" name="email" required>
        <label for="senha">Senha</label>
        <input type="password" placeholder="Insira a senha..." name="senha" required>
        <button type="submit" class="btn btn-primary mt-2">Cadastrar</button>
        <a href="index.php">Já é cadastrado? Logue aqui</a>
		<p><?=$alertaCadastro?></p>
    </form>
</section>


<?php
    include 'rodape.php';
?>
