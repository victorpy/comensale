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
<h2>Hola</h2> <h2> <?php  
if($_SESSION['role'] == 'report'){
	
	echo "{$_SESSION['email']} de \"Reportes\"";
		
}else if($_SESSION['role'] == 'admin'){
	
	echo "{$_SESSION['email']} \"Admin\"";
	
} else {
	echo "{$_SESSION['email']} de \"{$_SESSION['companyName']}\" ";  
}
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
