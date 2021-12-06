<?php

include 'topo.php';
include 'entidades/Restaurante.php';

$restaurante = Usuario::consultar_usuario($_POST['email']);
if( $restaurante instanceof usuario ) {
    header('location:cadastrar-restaurante.php?erro=true');
    exit;
} else {

// Cadastro na tabela usuário
$novo_usuario = new Usuario;
$novo_usuario->nome = $_POST['nome'];
$novo_usuario->telefone = $_POST['telefone'];
$novo_usuario->email = $_POST['email'];
$novo_usuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$novo_usuario->acesso = 'r';
$novo_usuario->cadastrar();

$novo_restaurante = new Restaurante;
$novo_restaurante->nome = $_POST['nome'];
$novo_restaurante->telefone = $_POST['telefone'];
$novo_restaurante->cnpj = $_POST['cnpj'];
$novo_restaurante->estado = $_POST['estado'];
$novo_restaurante->cidade = $_POST['cidade'];
$novo_restaurante->rua = $_POST['rua'];
$novo_restaurante->numero = $_POST['numero'];
$novo_restaurante->email = $_POST['email'];
$novo_restaurante->descricao = $_POST['descricao'];
$novo_restaurante->cadastrar();

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
?>
