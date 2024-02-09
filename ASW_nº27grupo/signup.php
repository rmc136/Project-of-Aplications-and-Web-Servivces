<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Include the database connection file
include('abreconexao.php');

// Define variables and set to empty values
$nomeErr = $idadeErr = $emailErr = $passwordErr = $genderErr = $addressErr = $cityErr = $zipErr = $phoneErr = "";
$nome = $idade = $email = $password = $gender = $address = $city = $zip = $phone = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate name
  if (empty($_POST["nome"])) {
    $nomeErr = "Name is required";
  } else {
    $nome = test_input($_POST["nome"]);
    // Check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$nome)) {
      $nomeErr = "Only letters and white space allowed";
    }
  }

  // Validate age
  if (empty($_POST["idade"])) {
    $idadeErr = "Age is required";
  } else {
    $idade = test_input($_POST["idade"]);
    // Check if age is a number
    if (!is_numeric($idade)) {
      $idadeErr = "Age must be a number";
    }
  }

  // Validate email
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  // Validate gender
  if(empty($_POST["gender"])){
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  // Validate address
  if(empty($_POST["address"])){
    $addressErr = "Address is required";
  } else {
    $address = test_input($_POST["address"]);
  }

  // Validate city
  if(empty($_POST["city"])){
    $cityErr = "City is required";
  } else {
    $city = test_input($_POST["city"]);
  }

  // Validate zip

  if(empty($_POST["zip"])){
    $zipErr = "Zip is required";
  } else {
    $zip = test_input($_POST["zip"]);
  }

  // Validate phone

  if(empty($_POST["phone"])){
    $phoneErr = "Phone is required";
  } else {
    $phone = test_input($_POST["phone"]);
  }

  // Validate password
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    // Hash the password for storage
    $password = password_hash($password, PASSWORD_DEFAULT);
  }

  // If all input is valid, check if name and email already exist, then insert the data into the database
  if (empty($nomeErr) && empty($idadeErr) && empty($emailErr) && empty($genderErr) && empty($addressErr) && empty($cityErr) && empty($zipErr) && empty($phoneErr) && empty($passwordErr)) {
    // Check if name or email already exist in the database
    $check_sql = "SELECT * FROM utilizador WHERE nome='$nome' OR email='$email'";
    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows > 0) {
      echo "<script>alert('The name or email already exists. Please try a different name or email.')</script>";
      echo "<script>window.location = 'login.php';</script>";
      
    } else {
        // Name and email do not exist, insert the data into the database
        // Prepare the SQL statement
        $sql = "INSERT INTO utilizador (nome, idade, email, gender, address, city, zip, phone, password) VALUES ('$nome', '$idade', '$email', '$gender', '$address', '$city', '$zip', '$phone', '$password')";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            // Redirect the user to the login page
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
  }

  // Close the database connection
  $conn->close();
}

// Helper function to sanitize input data
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>