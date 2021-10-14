<?php
include 'topo.php';
include 'entidades/Usuario.php';
$alertaLogin = '';

  //Lógica para as mensagens dos redirecionamentos
 if ($_GET) {
   if ($_GET['redirect'] == 1) {
     $alertaLogin='<div class="alert alert-success mt-2"> Usuário cadastrado com sucesso! </div>';
   } else if($_GET['redirect'] == 2) {
     $alertaLogin='<div class="alert alert-success mt-2"> Restaurante cadastrado com sucesso! </div>';
   }
}

  // Para quando o usuário for redirecionado ao login é para desloga-lo

  // Valida se o usuário existe
  if (isset($_POST['login'], $_POST['senha'])) {
    $usuario = Usuario::consultar_usuario($_POST['login']);
    if (!$usuario instanceof Usuario || !password_verify($_POST['senha'], $usuario->senha)) {
      $alertaLogin = '<div class="alert alert-danger mt-2"> Usuário ou senha inválidos! </div>';
    } else {
        Login::logar($usuario, $_POST['senha']);
    }
  }
?>

    <section class = "sec-formulario">
        <form method="post" class="formulario-login formulario mt-4">
            <label for="login">Login</label>
            <input type="text" placeholder="Insira o login..." name="login" required>
            <label for="senha">Senha</label>
            <input type="password" placeholder="Insira a senha..." name="senha" required>
            <button type="submit" class="btn btn-primary mt-2">Logar</button>
            <p><?=$alertaLogin?></p>
            <a href="cadastrar-usuario.php">Ainda não é cadastrado? Clique aqui</a>
        </form>
    </section>
    <section class = "sec-formulario">
      <div class="formulario-login formulario mt-4">
        <a href="cadastrar-restaurante.php">Quer se cadastrar como restaurante? Clique aqui</a>
      </div>
    </section>

<?php include 'rodape.php'; ?>
