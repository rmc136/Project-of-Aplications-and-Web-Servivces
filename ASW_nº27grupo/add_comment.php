<?php
session_start();
require_once 'abreconexao.php';

if (isset($_SESSION["nome"])) {
  $user_name = $_SESSION["nome"];
} else {
  $user_name = $_POST["name"];
}

$comment = $_POST["comment"];

$sql = "INSERT INTO comentarios (nome, comment, date) VALUES ('$user_name', '$comment', NOW())";
$result = mysqli_query($conn, $sql);

header("Location: forum.php");
exit;
?>