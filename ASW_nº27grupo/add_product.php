<?php
session_start();
require_once 'abreconexao.php';

if (isset($_SESSION["nome"])) {
  $user_name = $_SESSION["nome"];
}

$nome = $_POST["name"];
$brand = $_POST['marcas'];
$category = $_POST['categorias'];
$size = $_POST['tamanhos'];
$price = $_POST['price'];

$sql = "INSERT INTO produtos (username, name, categoria, tamanho, marca, preco) VALUES ('$user_name', '$nome', '$category', '$size', '$brand', '$price')";
$result = mysqli_query($conn, $sql);
echo "<script>alert('The Product as been added and its now available.')</script>";
echo "<script>window.location = 'projeto.php';</script>";
exit;
?>