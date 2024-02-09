<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();
include 'abreconexao.php';

if(isset($_SESSION["nome"])) {
  $user_name = $_SESSION["nome"];
}

// Get the user name and preferences from the form data
$item_category = $_POST['item_Category'];
$item_brand = $_POST['item_Brand'];
$item_size = $_POST['item_Size'];
$item_name = $_POST['item_Name'];
$item_price = $_POST['item_Price'];
$user_name_sell = $_POST['user_name_sell'];



// Check if the product exists in the table
$sql = "SELECT * FROM produtos WHERE username = '$user_name_sell' AND name = '$item_name' AND preco = '$item_price' AND categoria = '$item_category' AND marca = '$item_brand' AND tamanho = '$item_size'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
  // Product exists, check if the user name is already in the favorites list
  $row = mysqli_fetch_assoc($result);

  $product_id = $row['id'];
  $sql = "SELECT * FROM favorites WHERE user_id = '$user_name' AND product_id = '$product_id'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // remove the product from the favorites list
    $sql = "DELETE FROM favorites WHERE user_id = '$user_name' AND product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);
    echo "added";

  } else {
    // User name is not in the favorites list, add it
    $sql = "INSERT INTO favorites (user_id, product_id) VALUES ('$user_name', '$product_id')";
    $result = mysqli_query($conn, $sql);
    echo "removed";
  }
}
mysqli_close($conn);

?>