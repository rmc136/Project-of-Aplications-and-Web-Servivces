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
<title>Forum</title>
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
              <li><a href="">Forum</a></li>
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

    