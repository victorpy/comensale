<?php  
  
include("database/db_conection.php");//make connection here  
if(isset($_GET['name']))  
{  
    $name=$_GET['name'];//same  
    //$user_email=$_POST['email'];//same  
   
    if(strlen($name) < 4)  
    {  
        echo json_encode(array( 'success' => 'false', 'message' => 'Nombre buscado muy corto'));
        return;
        //exit(); 
    }  
    
  
    
//here query check weather if user already registered so can't register again.  
    $search_name_query="select * from comensal WHERE name like '%$name%';";  
    $query=mysqli_query($dbcon,$search_name_query);
  
    if(mysqli_num_rows($query)==0)  
    {  
		echo json_encode(array( 'success' => 'false', 'message'=>"No existe Comensal con nombre $name !"));
		return;
		//exit();  
    }
    //error_log($name);
    $rows = array();
    
    while( $row = mysqli_fetch_assoc($query)){
		$rows[] = $row;
	}
    //echo var_export($rows, true);
    
    $json = json_encode(array( 'success' => 'true', 'results' => $rows ));
    
    error_log($json);
    
    echo $json;
    return;
    //$name = $row['name'];
    //$id = $row['id'];
        //echo"<script>window.open('welcome.php','_self')</script>"; 
    //echo "<script>window.open('registerfood.php?id=$id&ci=$ci&name=$name','_self')</script>";  
 
  
}  
  
?>  
