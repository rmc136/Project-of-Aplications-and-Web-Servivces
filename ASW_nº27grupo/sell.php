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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="projeto.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<title>Sell</title>
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
              <li><a href="">Sell</a></li>
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
  <h1 class="text-center">Sell Product</h1>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form action="add_product.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Name of the Product:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control-file" id="image" name="image">
      </div>
      <div class="form-group">
        <label for="marcas">Marcas:</label>
        <select class="form-control" id="marcas" name="marcas" required>
          <option value="" disabled selected>Choose a Brand</option>
          <option value="moncler" name="moncler">Moncler</option>
          <option value="louis vuitton" name="louis vuitton">Louis Vuitton</option>
          <option value="palm angels" name="palm angels">Palm angels</option>
        </select>
      </div>
      <div class="form-group">
        <label for="categorias">Categorias:</label>
        <select class="form-control" id="categorias" name="categorias" required>
          <option value="" disabled selected>Choose a Category</option>
          <option value="t-shirt" name="t-shirt">T-shirt</option>
          <option value="jackets" name="jackets">Jackets</option>
          <option value="sweatshirts" name="sweatshirts">Sweatshirts</option>
        </select>
      </div>
      <div class="form-group">
          <label for="tamanhos">Tamanhos:</label>
          <select class="form-control" id="tamanhos" name="tamanhos" required>
            <option value="" disabled selected>Choose a Size</option>
            <option value="s" name="s">S</option>
            <option value="m" name="m">M</option>
            <option value="l" name="l">L</option>
          </select>
        </div>
        <div class="form-group">
          <label for="preco">Price:</label>
          <div class="input-group">
            <span class="input-group-addon">€</span>
            <input type="number" class="form-control" id="price" name="price" required>
          </div>
        </div>
        <?php if (isset($user_name)): ?>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
        <?php endif; ?>
        <?php if (!isset($user_name)): ?>
        <div class="alert alert-warning text-center" role="alert">
          Need to be logged in to sell a Product
        </div>
      <?php endif; ?>
    </form>
    </div>
  </div>
</div>

  
  </body>
</html>