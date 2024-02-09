<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION["nome"])) {
  $user_name = $_SESSION["nome"];
}

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="projeto.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<?php
include 'abreconexao.php';
// Check if the user is logged in
if ($user_name) {
  // Check if the user already has preferences saved in the database
  $query = "SELECT * FROM preferencias WHERE nome = '$user_name'";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    // If there was an error with the database query, return an error message
    echo "Error retrieving preferences: " . mysqli_error($conn);
  } else {
    // If the query was successful, check if the user has any saved preferences
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0) {
      // If the user has saved preferences, save the preferences in variables
      $row = mysqli_fetch_assoc($result);
      $brand = $row['marcas'];
      $category = $row['categorias'];
      $size = $row['tamanho'];
    }
  }
}
?>
<title>Projeto</title>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand text-center" href="#">
              <img src="logo.jpg" class="img-responsive" alt="Brand Image">
            </a>
            <a class="navbar-brand" href=""> FCUL_2HandCloth</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>                        
            </button>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="">Home</a></li>
              <li><a href="forum.php">Forum</a></li>
              <li><a href="sell.php">Sell</a></li>
              <li><a href="buy.php">Buy</a></li>
              <?php if (isset($user_name)): ?>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
              <?php else: ?>
              <li><a href="login.php"> Sign up</a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container">
        <div class="jumbotron">
          <h1>Welcome to FCUL_2HandCloth</h1>
          <p>Buy and sell second-hand clothes at the University of Lisbon</p>

        </div>
        <div class="row">
          <div class="col-md-4">
            <h2>Buy</h2>
            <p>Browse through our wide selection of gently used clothing, shoes, and accessories at unbeatable prices. Whether you're looking for something casual or dressy, we've got you covered.</p>
            <p><a class="btn btn-primary" href="buy.php" role="button">View details &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Sell</h2>
            <p>Have clothes you no longer wear? We make it easy to turn your unwanted items into cash. Simply bring in your items, and we'll take care of the rest. Our team will sort, price, and display your clothes for you.</p>
            <p><a class="btn btn-primary" href="sell.php" role="button">View details &raquo;</a></p>
         </div>
          <div class="col-md-4">
            <h2>Feedback</h2>
            <p> We value your opinion and want to hear about your shopping experience with us. Leave us a review or send us a message with any comments, concerns, or suggestions you may have.</p>
            <p><a class="btn btn-primary" href="forum.php" role="button">View details &raquo;</a></p>
          </div>
        </div>
      </div>
      </div>
      <div class="container">
        <div class="row">
            <?php 
              // Fetch the 3 random products from the database that match the user's preferences
              $sql = "SELECT * FROM produtos WHERE categoria = '$category' OR marca = '$brand' OR tamanho = '$size'";
              $result = mysqli_query($conn, $sql);
              if (isset($user_name)) {
                echo "<h2 class='text-center'>Recommendations:</h2>";
              }
              // Loop through the products and display them
              while($row = mysqli_fetch_assoc($result)) {
                  // Get the product information from the current row
                  $product_name = $row['name'];
                  $price = $row['preco'];
                  $category = $row['categoria'];
                  $brand = $row['marca'];
                  $size = $row['tamanho'];
                  $username = $row['username'];
                  $product_name = ucfirst($product_name);
                  $category = ucfirst($category);
                  $brand = ucfirst($brand);
                  $size = ucfirst($size);
                  // Display the product in the HTML format if the user is logged in and has saved preferences

                  if ($user_name) {
                    if ($row_count > 0) {
                      if ($category == $category || $brand == $brand || $size == $size) {
                        echo "
                        <div class='col-md-4'>
                        <div class='thumbnail'>
                          <img src='img.jpg' alt=''>
                          <div class='caption'>
                          <br>
                          <br>
                            <h3>$product_name</h3>
                            <p>$price €</p>
                            <p>$category</p>
                            <p>$brand</p>
                            <p>$size</p>
                            <p><a href='#' class='btn btn-primary' role='button'>Buy</a></p>
                          </div>
                        </div>
                        <br>
                        <br>
                      </div>";
                      }
                    }
                    
              }
             
            }


          ?>
          </div>
        </div>
      </div>
      
</body>
</html>