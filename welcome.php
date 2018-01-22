<?php  
session_start();  
  
if(!$_SESSION['email'])  
{  
  
    header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
}  
  
?>  
  
<html>  
<head lang="en">  
    <meta charset="UTF-8">  
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">  
    <title>Principal</title>  
</head>  
<style>  
    .login-panel {  
        margin-top: 150px;  
  
</style>  
  
<body>  
<h1>Hola</h1> <h2> <?php  
echo $_SESSION['email'];  
?>  
  </h2> 
  
<br>

<?php if($_SESSION['role'] == 'user') { ?>
<a href="addcomensal.php"><button class="btn btn-danger">Agregar Nuevo Comensal</button></a>
<a href="search.php"><button class="btn btn-danger">Buscar Comensal</button></a>
<a href="reports.php"><button class="btn btn-danger">Reportes</button></a>
  
<?php } else if($_SESSION['role'] == 'report') { ?>  

<a href="reports.php"><button class="btn btn-danger">Reportes</button></a>

<?php }?>
  
<h1><a href="logout.php">Salir</a> </h1>  
  
  
</body>  
  
</html>
