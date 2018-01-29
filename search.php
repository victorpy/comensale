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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Buscar Comensal</title>  
</head>  
<style>  
    .login-panel {  
        margin-top: 150px;  
  
</style>  

<script>
function search(name){
        var params = {
                "name" : name
        };
        $.ajax({
                data:  params,
                url:   'searchbyname.php',
                type:  'get',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
					
					 //console.log(response);
					 //
					 json_obj = $.parseJSON(response);//parse JSON
					 
					 if(json_obj.success === 'false'){
						 alert('Error '+json_obj.message);
						  $("#resultado").html("");
						  return;
					 }
					 
					 var rows = json_obj.results;
					 
					 var output="<table class=\"table table-striped\"><thead><tr><th>Nombre</th><th>CI</th><th>Registrar</th></thead><tbody>";
					 //'registerfood.php?id=$id&ci=$ci&name=$name'
					 for (var i in rows)
					 {//<a href="https://www.w3schools.com/html/">Visit our HTML tutorial</a>
						var reglink = "<a href=\"registerfood.php?id="+rows[i].id+"&ci="+rows[i].ci+"&name="+rows[i].name+"\">Cargar comida</a>" ;
						output+="<tr><td>" + rows[i].name + "</td><td>" + rows[i].ci + "</td><td>" + reglink + "</td></tr>";
					 }
					 
					 output+="</tbody></table>";
 
					
                     $("#resultado").html(output);
                }
        });
}
</script>


<body>  
<br>
<a href="welcome.php"><button class="btn btn-danger">Inicio</button></a>
<a href="logout.php"><button class="btn btn-danger">Salir</button></a>
  
<div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->  
    <div class="row"><!-- row class is used for grid system in Bootstrap-->  
        <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->  
            <div class="login-panel panel panel-success">  
                <div class="panel-heading">  
                    <h3 class="panel-title">Buscar Comensal</h3>  
                </div>  
                <div class="panel-body">  
                    <form role="form" method="post" action="search.php">  
                        <fieldset>  
                            
                            <div class="form-group">  
                                <input class="form-control" placeholder="Nombre" id="name" name="name" type="text" autofocus>  
                            </div>  
                            <!--<div class="form-group">  
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">  
                            </div>  -->
  
  
                           <!-- <input class="btn btn-lg btn-success btn-block" type="submit" value="Buscar" name="search" >  -->
                            <input class="btn btn-lg btn-success btn-block" href="javascript:;" onclick="search($('#name').val());return false;" value="Buscar"/>
  
                        </fieldset>  
                    </form>  
      
                </div>  
            </div>  
        </div>  
    </div>  
</div>  

<div class="container">
	<div class="row">
		Resultado: <span id="resultado"></span>
	</div>
</div>
  
</body>  
  
</html>  
  
<?php  
  
include("database/db_conection.php");//make connection here  
if(isset($_POST['search']))  
{  
    $ci=$_POST['ci'];//same  
    //$user_email=$_POST['email'];//same  
   
    if($ci=='')  
    {  
        echo"<script>alert('Ingresa numero de cedula')</script>";  
		exit();  
    }  
  
    
//here query check weather if user already registered so can't register again.  
    $check_ci_query="select * from comensal WHERE ci='$ci'";  
    $run_query=mysqli_query($dbcon,$check_ci_query);
  
    if(mysqli_num_rows($run_query)==0)  
    {  
		echo "<script>alert('No existe Comensal con ci: $ci !')</script>";  
		exit();  
    }
    
    $row = mysqli_fetch_assoc($run_query);
    
    $name = $row['name'];
    $id = $row['id'];
        //echo"<script>window.open('welcome.php','_self')</script>"; 
    echo "<script>window.open('registerfood.php?id=$id&ci=$ci&name=$name','_self')</script>";  
  
  
}  
  
?>  
