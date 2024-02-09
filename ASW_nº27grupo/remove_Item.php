<?php
include 'abreconexao.php';

// Get the user name and preferences from the form data
$item_category = $_POST['item_Category'];
$item_brand = $_POST['item_Brand'];
$item_size = $_POST['item_Size'];
$item_name = $_POST['item_Name'];
$item_price = $_POST['item_Price'];
$user_name = $_POST['user_name'];


// remove the item from the database
$query = "DELETE FROM produtos WHERE username = '$user_name' AND name = '$item_name' AND preco = '$item_price' AND categoria = '$item_category' AND marca = '$item_brand' AND tamanho = '$item_size'";
$result = mysqli_query($conn, $query);


if ($result) {
  echo "Item removed successfully";
} else {
  echo "Error removing item: " . mysqli_error($conn);
}

mysqli_close($conn);
?>