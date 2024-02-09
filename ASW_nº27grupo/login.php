<!DOCTYPE html>
<html>
<?php
// Include the database connection file
include('abreconexao.php');

// Define variables and set to empty values
$nomeErr = $passwordErr = "";
$nome = $password = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate name
  if (empty($_POST["nome"])) {
    $nomeErr = "Name is required";
  } else {
    $nome = test_input($_POST["nome"]);
  }

  // Validate password
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }

  // If both name and password are provided, check if the account exists
  if (!empty($nome) && !empty($password)) {
    // Prepare the SQL statement
    $sql = "SELECT nome, password FROM utilizador WHERE nome='$nome'";

    // Execute the SQL statement
    $result = $conn->query($sql);

    // Check if the account exists
    if ($result->num_rows > 0) {
      // Get the password hash from the database
      $row = $result->fetch_assoc();
      $hashed_password = $row["password"];

      // Check if the password is correct
      if (password_verify($password, $hashed_password)) {
        // Start the session and store the user ID
        session_start();
        $_SESSION["nome"] = $row["nome"];
        if (isset($_SESSION["nome"])) {
          $user_name = $_SESSION["nome"];
        }
        // Redirect the user to the dashboard
        header("Location: projeto.php");
        exit();
      } else {
        // Password is incorrect
        $passwordErr = "Invalid password";
      }
    } else {
      // Account does not exist
      $nomeErr = "Account not found";
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

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="projeto.css">
<link rel="stylesheet" href="login.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<title>Sign up</title>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand text-center" href="#">
              <img src="logo.jpg" class="img-responsive" alt="Brand Image">
            </a>
            <a class="navbar-brand" href="projeto.php"> FCUL_2HandCloth</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>                        
            </button>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="projeto.php">Home</a></li>
              <li><a href="forum.php">Forum</a></li>
              <li><a href="sell.php">Sell</a></li>
              <li><a href="buy.php">Buy</a></li>
              <?php if (isset($user_name)): ?>
                <li><a href="logout.php">Logout</a></li>
              <?php else: ?>
              <li><a href="login.php"> Sign up</a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container">

        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#login">Login</a></li>
          <li><a data-toggle="tab" href="#signup">Sign Up</a></li>
        </ul>
      
        <div class="tab-content">
          <div id="login" class="tab-pane fade in active">
            <h3>Login</h3>
            <form method="POST" action="login.php">
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="name" class="form-control" id="nome" name="nome" required>
              </div>
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="password" required>
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
          </div>
          <div id="signup" class="tab-pane fade">
            <h3>Sign Up</h3>
            <form method="post" action="signup.php"> 
              <div class="form-group" >
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
              </div>
              <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
              </div>
              <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="number" class="form-control" id="idade" max="120" min="18" name="idade" required>
              </div>
              <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" name="gender" id="gender" required>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
              <div class="form-group">
                <label for="address">Adress:</label>
                <input type="text" class="form-control" id="address" name="address" required>
              </div>
              <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" required>
              </div>
              <div class="form-group">
                <label for="zip">Zip code:</label>
                <input type="text" class="form-control" id="zip" name="zip" required>
              </div>
              <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" class="form-control" pattern="[9]{1}[0-9]{8}" required>
              </div>
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="password" required>
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
          </div>
        </div>
      
      </div>
    
</body>
</html>