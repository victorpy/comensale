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
  
<div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->  
    <div class="row"><!-- row class is used for grid system in Bootstrap-->  
        <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->  
            <div class="login-panel panel panel-success">  
                <div class="panel-heading">  
                    <h3 class="panel-title">Registracion de Comensal</h3>  
                </div>  
                <div class="panel-body">  
                    <form role="form" method="post" action="addcomensal.php">  
                        <fieldset>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Nombre" name="name" type="text" autofocus>  
                            </div>  
  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Cedula" name="ci" type="text" autofocus>  
                            </div>  
                            <!--<div class="form-group">  
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">  
                            </div>  -->
  
  
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
if(isset($_POST['register']))  
{  
    $name=$_POST['name'];//here getting result from the post array after submitting the form.  
    $ci=$_POST['ci'];//same  
    //$user_email=$_POST['email'];//same  
  
  
    if($name=='')  
    {  
        //javascript use for input checking  
        echo"<script>alert('Ingresa un nombre')</script>";  
		exit();//this use if first is not work then other will not show  
    }  
  
    if($ci=='')  
    {  
        echo"<script>alert('Ingresa cedula de identidad')</script>";  
		exit();  
    }  
  
    
//here query check weather if user already registered so can't register again.  
    $check_ci_query="select * from comensal WHERE ci='$ci'";  
    $run_query=mysqli_query($dbcon,$check_ci_query);
  
    if(mysqli_num_rows($run_query)>0)  
    {  
		echo "<script>alert('Comensal con ci: $ci ya existe, probar otro!')</script>";  
		exit();  
    }  
//insert the user into the database.  
    $insert_user="insert into comensal (name,ci) VALUES ('$name','$ci')";  
    //error_log($insert_user);
    if(mysqli_query($dbcon,$insert_user))  
    {  
        //echo"<script>window.open('welcome.php','_self')</script>"; 
        echo "<script>alert('Comensal con ci: $ci creado!')</script>";   
        echo "<script>window.open('welcome.php','_self')</script>";  
    }  
  
  
  
}  
  
?>  
