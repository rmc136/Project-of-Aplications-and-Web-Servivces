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
<script src="buy2.js"></script>
<style>
.favorite-button {
  margin-left: 10px;
}
</style>
<?php
include 'abreconexao.php';
// Check if the user is logged in
if ($user_name) {
  // Check if the user already has preferences saved in the database
  $query = "SELECT * FROM preferencias WHERE nome = '$user_name'";
  $result = mysqli_query($conn, $query);

  if ($row_count > 0) {
    // If the user has saved preferences, pre-select the corresponding options in the form
    $row = mysqli_fetch_assoc($result);
    $brands = explode(",", $row['marcas']); // convert comma-separated string to array
    $categories = explode(",", $row['categorias']); // convert comma-separated string to array
    $sizes = explode(",", $row['tamanho']); // convert comma-separated string to array
    echo "<script>
              $(document).ready(function() {
              $('#marcas').val(".json_encode($brands).");
              $('#categorias').val(".json_encode($categories).");
              $('#tamanhos').val(".json_encode($sizes).");
              
            });
          </script>";
  }
  }
?>
<script> 
  $(document).ready(function() {
    // Add support for selecting multiple options in each filter
    $('select[multiple]').multiselect({
      includeSelectAllOption: true,
      selectAllText: 'Selecionar todos',
      enableFiltering: true,
      filterPlaceholder: 'Buscar',
      nonSelectedText: 'Nenhum selecionado',
      enableCaseInsensitiveFiltering: true
    });
  });
</script>
<script src="filter3.js"></script>
<title>Buy</title>
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
              <li><a href="">Buy</a></li>
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
  <div class="container text-center">
  <div class="row">

  <form class="form-inline">
      <div class="form-group">
        <label for="marcas">Marcas:</label>
        <select class="form-control" id="marcas" name="marcas" >
          <option value="all">Todos</option>
          <option value="moncler" name="moncler">Moncler</option>
          <option value="louis vuitton" name="louis vuitton">Louis Vuitton</option>
          <option value="palm angels" name="palm angels">Palm angels</option>
        </select>
      </div>
      <div class="form-group">
        <label for="categorias">Categorias:</label>
        <select class="form-control" id="categorias" name="categorias">
          <option value="all" name="all">Todas</option>
          <option value="t-shirt" name="t-shirt">T-shirt</option>
          <option value="jackets" name="jackets">Jackets</option>
          <option value="sweatshirts" name="sweatshirts">Sweatshirts</option>
        </select>
      </div>
      <div class="form-group">
          <label for="tamanhos">Tamanhos:</label>
          <select class="form-control" id="tamanhos" name="tamanhos" >
            <option value="all" name="all">Todos</option>
            <option value="s" name="s">S</option>
            <option value="m" name="m">M</option>
            <option value="l" name="l">L</option>
          </select>
        </div>
        <input type="hidden" id="user_name" name="user_name" value="<?php echo isset($user_name) ? $user_name : '' ?>">
        <button type="submit" class="btn btn-default">Filtrar</button>
      </form>
    </div>
  </div>
  <br>
  <br>
      <div class="col-sm-12">
        <div class="row">
        <?php 
          // Fetch the products from the database
          $sql = "SELECT * FROM produtos";
          $result = mysqli_query($conn, $sql);
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
              

              // Display the product in the HTML format
                echo "<div class='col-sm-4'>";
                  echo "<div class='thumbnail'>";
                    echo "<div class='caption'>";
                      echo "<h4 class='product_name'> $product_name </h4>";
                      echo "<p class='price'>Price: $price €</p>";
                      echo "<p class='size'>Size:  $size </p>";
                      echo "<p class='category'>Category:  $category </p>";
                      echo " <p class='brand'>Brand: $brand </p>";
                      echo "<p class='description'>Seller:  $username </p>";
                      if (isset($user_name)):
                        echo "<div>";
                        echo  "<button type='submit' class='btn btn-primary buy'>Buy</button>";
                        echo  "<button type='submit' class='btn btn-primary favorite-button'>Mark as favorite</button>";
                        echo "</div>";
                      endif;
                      if (!isset($user_name)):
                        echo  "<div class='alert alert-warning text-center' role='alert'>";
                        echo  "Need to be logged in to buy a Product";
                        echo "</div>";
                      endif;
                    echo "</div> "   ;
                  echo "</div>";
                echo "</div>";
              }
          ?>
    </div>
  </div>

</body>
</html>