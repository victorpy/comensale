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
    <title>Reportes</title>  
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

<a href="viewbymonth.php"><button class="btn btn-danger">Planilla Todos por Mes</button></a>
<!-- <a href="search.php"><button class="btn btn-danger">Planilla por Semana</button></a>
<a href="search.php"><button class="btn btn-danger">Planilla por Comensal por Mes</button></a> -->
  
<h1><a href="logout.php">Salir</a> </h1>  
  
  
</body>  
  
</html>
