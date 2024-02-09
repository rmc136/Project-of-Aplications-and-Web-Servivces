<?php

// Include the database connection file
include 'abreconexao.php';

// Get the user name and preferences from the form data
$user_name = $_POST['user_name'];
$brand = $_POST['brand'];
$category = $_POST['category'];
$size = $_POST['size'];

// Check if the user is logged in
if ($user_name) {
  // Check if the user already has preferences saved in the database
  $query = "SELECT * FROM preferencias WHERE nome = '$user_name'";
  $result = mysqli_query($conn, $query);
  $row_count = mysqli_num_rows($result);

  if ($row_count == 0) {
    // If the user doesn't have preferences saved, insert a new row in the database
    $query = "INSERT INTO preferencias (nome, marcas, categorias, tamanho) VALUES ('$user_name', '$brand', '$category', '$size')";
  } else {
    // If the user already has preferences saved, update the existing row in the database
    $query = "UPDATE preferencias SET marcas = '$brand', categorias = '$category', tamanho = '$size' WHERE nome = '$user_name'";
  }

  // Execute the database query
  $result = mysqli_query($conn, $query);

  if (!$result) {
    // If there was an error with the database query, return an error message
    echo "Error saving preferences: " . mysqli_error($conn);
  } else {
    // If the preferences were saved successfully, return a success message
    echo "Preferences saved successfully.";
  }
}
?>
