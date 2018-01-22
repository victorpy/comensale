<?php  
session_start();//session starts here  
  
?>  
  

<html>  
<head lang="en">  
    <meta charset="UTF-8">  
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">  
    <title>Admin Login</title>  
</head>  
<style>  
    .login-panel {  
        margin-top: 150px;  
  
</style>  
  
<body>  
  
<div class="container">  
    <div class="row">  
        <div class="col-md-4 col-md-offset-4">  
            <div class="login-panel panel panel-success">  
                <div class="panel-heading">  
                    <h3 class="panel-title">Ingresar</h3>  
                </div>  
                <div class="panel-body">  
                    <form role="form" method="post" action="admin_login.php">  
                        <fieldset>  
                            <div class="form-group"  >  
                                <input class="form-control" placeholder="Name" name="username" type="text" autofocus>  
                            </div>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">  
                            </div>  
  
  
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="admin_login" >  
  
  
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
/** 
 * Created by PhpStorm. 
 * User: Ehtesham Mehmood 
 * Date: 11/24/2014 
 * Time: 3:26 AM 
 */  
include("database/db_conection.php");  
  
if(isset($_POST['admin_login']))//this will tell us what to do if some data has been post through form with button.  
{  
    $username=$_POST['username'];  
    $password=$_POST['password'];  
  
    $admin_query="select * from users where username='$username' AND password='$password' and role='admin'";  
  
    $run_query=mysqli_query($dbcon,$admin_query);  
	
	//error_log(var_dump($run_query, true));
	
	if (!$run_query) {
        echo("Error: ".mysqli_error($dbcon));
    }
    
    if(mysqli_num_rows($run_query)>0)  
    {    
        echo "<script>window.open('view_users.php','_self')</script>";  
        $row = mysqli_fetch_row($run_query);
        error_log(" $row[3] $row[4] ");
        $_SESSION['email']=$row[3];//here session is used and value of $user_email store in $_SESSION.         
        $_SESSION['role']=$row[4];
        
    }  
    else {echo"<script>alert('Datos incorrectos, favor pruebe nuevamente..!')</script>";}  
  
}  
  
?>
