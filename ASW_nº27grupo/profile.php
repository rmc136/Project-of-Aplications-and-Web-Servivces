<!DOCTYPE html> 
<?php
session_start();
include 'abreconexao.php';
if (isset($_SESSION["nome"])) {
  $user_name = $_SESSION["nome"];
}

// retrieve user information from utilizadores table
$sql = "SELECT * FROM utilizador WHERE nome = '$user_name'";
$result = mysqli_query($conn, $sql); // execute the query
$user_info = mysqli_fetch_assoc($result); // fetch the result as an associative array

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $address = test_input($_POST["address"]);
  $city = test_input($_POST["city"]);
  $zip = test_input($_POST["zip"]);
  $phone = test_input($_POST["phone"]);
  $password = test_input($_POST["password"]);
  // Hash the password for storage
  $password = password_hash($password, PASSWORD_DEFAULT);
  $check_sql = "UPDATE utilizador SET address='$address', city='$city', zip='$zip', phone='$phone', password='$password' WHERE nome='$user_name'";
      // Execute the SQL statement
      if ($conn->query($check_sql) === TRUE) {
          // Redirect the user to the login page
          header("Location: profile.php");
          exit();
      } else {
          echo "Error: " . $check_sql . "<br>" . $conn->error;
      }
  }
// Helper function to sanitize input data
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


mysqli_close($conn); // close the database connection
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="projeto.css">
<link rel="stylesheet" href="profile.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<title>Profile</title>
</head>
<body class="text-center">
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
                <li><a href="">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
              <?php else: ?>
              <li><a href="login.php"> Sign up</a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container tex">
		<h1><?php echo $user_name?>´s Profile</h1>
        <br>
        <br>
		<!-- User info section -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
            <form method="POST" action="profile.php">
              <div class="form-group">
                <label for="address">Adress:</label>
                <input type="text" class="form-control text-center" id="address" name="address" value="<?php echo $user_info['address']; ?>" required >
              </div>
              <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control text-center" id="city" name="city" value="<?php echo $user_info['city']; ?>" required>
              </div>
              <div class="form-group">
                <label for="zip">Zip code:</label>
                <input type="text" class="form-control text-center" id="zip" name="zip" value="<?php echo $user_info['zip']; ?>" required>
              </div>
              <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" class="form-control text-center" value="<?php echo $user_info['phone']; ?>" pattern="[9]{1}[0-9]{8}" required>
              </div>
              <div class="form-group">
                <label for="pwd">New password:</label>
                <input type="password" class="form-control text-center" id="pwd" name="password" required>
              </div>
					<button type="submit" class="btn btn-primary text-center">Save Changes</button>
				</form>
			</div>
		</div>
	</div>       
</body>
</html>