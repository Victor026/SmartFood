<?php
    include 'topo.php';
    include 'entidades/Usuario.php';
    $alertaCadastro = '';

    if( $_POST ) {

        $usuario = Usuario::consultar_usuario($_POST['email']);
        if( $usuario instanceof Usuario ) {
            $alertaCadastro = '<div class="alert alert-danger mt-2"> Email já existente! Por favor selecione outro </div>';
            exit;
        }

        $novo_usuario = new Usuario;
        $novo_usuario->cpf = $_POST['cpf'];
        $novo_usuario->nome = $_POST['nome'];
        $novo_usuario->telefone = $_POST['telefone'];
        $novo_usuario->email = $_POST['email'];
        $novo_usuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $novo_usuario->acesso = 'u';
        $novo_usuario->cadastrar();
        header("location:index.php?redirect=1");
        exit;
    }
?>

<section class = "sec-formulario">
    <form method="post" class="formulario-login formulario mt-4">
        <label for="nome">Nome do usuário</label>
        <input type="text" placeholder="Insira o nome do usuário" name="nome" required>
        <label for="nome">CPF do usuário</label>
        <input type="text" placeholder="Insira o cpf do usuário" name="cpf" required>
        <label for="nome">Telefone do usuário</label>
        <input type="text" placeholder="Insira o telefone do usuário" name="telefone" required>
        <label for="email">E-mail</label>
        <input type="text" placeholder="Insira o email do usuário" name="email" required>
        <label for="senha">Senha</label>
        <input type="password" placeholder="Insira a senha..." name="senha" required>
        <button type="submit" class="btn btn-primary mt-2">Cadastrar</button>
        <p><?=$alertaCadastro?></p>
        <a href="index.php">Já é cadastrado? Logue aqui</a>
    </form>
</section>


<?php
    include 'rodape.php';
?>
