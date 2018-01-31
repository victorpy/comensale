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
    <title>Agregar Comensal</title>  
</head>  
<style>  
    .login-panel {  
        margin-top: 150px;  
  
</style>  
<body> 

<br>
<a href="welcome.php"><button class="btn btn-danger">Inicio</button></a>
<a href="logout.php"><button class="btn btn-danger">Salir</button></a> 
  
<div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->  
    <div class="row"><!-- row class is used for grid system in Bootstrap-->  
        <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->  
            <div class="login-panel panel panel-success">  
                <div class="panel-heading">  
                    <h3 class="panel-title">Registro de Consumo</h3>  
                </div>  
                <div class="panel-body">  
                    <form role="form" method="post" action="registerfood.php">  
                        <fieldset>  
							<div class="form-group">  
                                <input class="form-control" placeholder="Id" name="id" type="hidden" value="<?php echo isset($_GET['id']) ? $_GET['id'] : "" ?>" autofocus>  
                            </div>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Cedula" name="ci" type="text" value="<?php echo isset($_GET['ci']) ? $_GET['ci'] : "" ?>" autofocus>  
                            </div>  
  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Nombre" name="name" type="text" value="<?php echo isset($_GET['name']) ? $_GET['name'] : "" ?>" autofocus>  
                            </div>  
                            <!--<div class="form-group">  
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">  
                            </div>  -->
                            
                             <div class="form-group">
							  <label for="type">Seleccionar:</label>
							  <select class="form-control" id="type" name="type">
								<option value="ALMUERZO">ALMUERZO</option>
								<option value="MERIENDA">MERIENDA</option>								
							  </select>
							</div> 
  
  
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Registrar" name="register" >  
  
                        </fieldset>  
                    </form>  
      
                </div>  
            </div>  
        </div>  
    </div>  
</div>  
  
</body>  
  
</html>  
  
<?php  
  
include("database/db_conection.php");//make connection here  
//error_log("11111111111111");
if(isset($_POST['register']))  
{  
	
	$id = $_POST['id'];
    $name=$_POST['name'];//here getting result from the post array after submitting the form.  
    $ci=$_POST['ci'];//same  
    $type=$_POST['type'];
    //$user_email=$_POST['email'];//same  
	
	//error_log("22222222222  $id - $name - $ci ");
  
    if($name=='')  
    {  
        //javascript use for input checking  
        echo "<script>alert('Ingresa un nombre')</script>";  
        return;
		//exit();//this use if first is not work then other will not show  
    }  
  
    if($ci=='')  
    {  
        echo"<script>alert('Ingresa cedula de identidad')</script>";  
        return;
		//exit();  
    }  
  
	$today = date("Y-m-d");
    $select_sql = "select * from registro where id_comensal = $id and date = '$today'";
    error_log($select_sql);

	$run = mysqli_query($dbcon,$select_sql);
	$row = mysqli_fetch_row($run);
	
	if($row != null){
		echo"<script>alert('Comensal $name con $ci ya tiene un registro el dia de hoy')</script>";  
		echo "<script>window.open('welcome.php','_self')</script>"; 
        return;
	}
      
//insert the user into the database.  
    $insert_user="insert into registro (id_comensal,date, type, amount, company) VALUES ('$id', CURRENT_TIMESTAMP, '$type', 10000,  {$_SESSION['company']})";  
    //error_log($insert_user);
    if(mysqli_query($dbcon,$insert_user))  
    {  
        //echo"<script>window.open('welcome.php','_self')</script>"; 
        echo "<script>alert('Regsitro para Comensal con ci: $ci creado!')</script>";   
        echo "<script>window.open('welcome.php','_self')</script>";  
    } else {
		error_log("DB Error description: " . mysqli_error($dbcon));
	}  
  
  
  
}  
  
?>  
