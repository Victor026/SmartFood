<?php

include 'topo.php';
include 'entidades/prato.php';
print_r($_POST);
if($_POST['preco'] <= 0) {
	header('location: registrar-prato.php?'.$_POST['restaurante'].'&erro=true');
	exit;
}

$novo_prato = new Prato;
$novo_prato->id_restaurante = $_POST['restaurante'];
$novo_prato->nome = $_POST['nome'];
$novo_prato->descricao = $_POST['descricao'];
$novo_prato->preco = $_POST['preco'];
$novo_prato->cadastrar();

$target_dir = "src/img/fotos_pratos/";
$target_file = $target_dir . 'prato-'.$novo_prato->id.'.jpg';
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
if ($_FILES["fileToUpload"]["size"] > 900000000000) {
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

header("location:pag-inicial-res.php?redirect=2");
exit;
?>
