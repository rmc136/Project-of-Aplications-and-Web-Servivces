<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION["nome"])) {
  $user_name = $_SESSION["nome"];
}

?>   
<html>   
<head>  
<meta name="viewport" content="width=device-width, initial-scale=1">  
<title> Admin Page </title>  
<!-- added bootstrap CDN link -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
  /* added custom style for centering the text and table */
  body {
    text-align: center;
    margin-top: 50px;
  }
  table {
    margin: auto;
  }
</style>
</head>
<body>
<!-- added bootstrap container -->
<div class="container">
  <h1> Admin </h1>
  <p>Para usar basta escolher qual o filtro quer usar, escrever o que procura (colocando todo a informação) e clicar "Enviar".
    <br>
    Para ter acesso a todos os dados novamente, apenas clique no botão "Enviar"
  </p>
  <br>
  <!-- added bootstrap form and classes -->
  <form class="form-inline" method="post">
    <div class="form-group">
      <select class="form-control" name="option">
        <option value="email" selected>Email</option>
        <option value="nome">Nome</option>
        <option value="address">Endereço</option>
        <option value="zip">Código Postal</option>
        <option value="gender">Género</option>
        <option value="idade">Idade</option>
      </select>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="text">
    </div>
    <button type="submit" class="btn btn-primary" name="button">Enviar</button>
  </form>
  <br>
  <?php
        include("abreconexao.php"); 
        $sql = "SELECT * FROM utilizador";
        
        if (isset($_POST['text'])) {
            $filter = mysqli_real_escape_string($conn, $_POST['text']);
            $opt = $_POST["option"];   
                  
        }
        
        if ($filter != '') {
            $sql .= " WHERE $opt LIKE '$filter'";
        }
        
        $result = mysqli_query($conn, $sql);
        echo "<table class='table table-bordered'>
        <tr>
        <th>Email</th>
        <th>Nome</th>
        <th>Endereço</th>
        <th>Código Postal</th>
        <th>Género</th>
        <th>Idade</th>
        </tr>";

        while($row = mysqli_fetch_array($result))
        {
        echo "<tr>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['zip'] . "</td>";
        echo "<td>" . $row['gender'] . "</td>";
        echo "<td>" . $row['idade'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";

        mysqli_close($con);
        

        
        ?>            
    </table>
  </div>
</body>
</html>