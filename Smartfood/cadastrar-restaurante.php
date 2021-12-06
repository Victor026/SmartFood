<?php
    include 'topo.php';
    include 'entidades/Restaurante.php';
    $alertaCadastro = '';

    if (isset($_GET['erro'])) {
      $alertaCadastro = '<div class="alert alert-danger mt-2"> Email já existente! Por favor selecione outro </div>';
    }

    // if( $_POST ) {
    //
    //     $restaurante = Restaurante::consultar_restaurante($_POST['email']);
    //     if( $restaurante instanceof Restaurante ) {
    //         $alertaCadastro = '<div class="alert alert-danger mt-2"> Email já existente! Por favor selecione outro </div>';
    //     } else {
    //
    //     // Cadastro na tabela restaurante
    //     $novo_restaurante = new Restaurante;
    //     $novo_restaurante->nome = $_POST['nome'];
    //     $novo_restaurante->cnpj = $_POST['cnpj'];
    //     $novo_restaurante->estado = $_POST['estado'];
    //     $novo_restaurante->cidade = $_POST['cidade'];
    //     $novo_restaurante->rua = $_POST['rua'];
    //     $novo_restaurante->numero = $_POST['numero'];
    //     $novo_restaurante->telefone = $_POST['telefone'];
    //     $novo_restaurante->email = $_POST['email'];
    //     $novo_restaurante->descricao = $_POST['descricao'];
    //     $novo_restaurante->cadastrar();
    //
    //     // Cadastro na tabela usuário
    //     $novo_usuario = new Usuario;
    //     $novo_usuario->nome = $_POST['nome'];
    //     $novo_usuario->telefone = $_POST['telefone'];
    //     $novo_usuario->email = $_POST['email'];
    //     $novo_usuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    //     $novo_usuario->acesso = 'r';
    //     $novo_usuario->cadastrar();
    //     header("location:index.php?redirect=2");
    //     exit;
    //     }
    // }
?>

<section class = "sec-formulario">
    <form method="post" class="formulario-login formulario mt-4" action="upload.php" enctype="multipart/form-data">
      <h3>Cadastrar restaurante</h3>
        <label for="nome">Selecione a imagem do restaurante:</label>
		    <input type="file" name="fileToUpload" id="fileToUpload">
        <label for="nome">Nome do restaurante</label>
        <input type="text" placeholder="Insira o nome do restaurante" name="nome" required>
        <label for="telefone">Telefone do restaurante</label>
        <input type="text" placeholder="Insira o telefone do restaurante" name="telefone" required>
        <label for="cnpj">CNPJ do restaurante</label>
        <input type="text" placeholder="Insira o cnpj do restaurante" name="cnpj" required>
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
        <p><?=$alertaCadastro?></p>
    </form>
</section>
  <section class = "sec-formulario">
    <a href="index.php" class="btn btn-danger mt-4">Voltar para página inicial</a>
  </section>

  <br><br>


<?php
    include 'rodape.php';
?>
