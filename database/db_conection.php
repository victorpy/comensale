<?php  
/** 
 * Created by PhpStorm. 
 * User: Ehtesham Mehmood 
 * Date: 11/21/2014 
 * Time: 1:13 AM 
 */  
$dbcon=mysqli_connect("localhost","root","0m1cr0ns3rv3r");  

if (mysqli_connect_errno()) {
    error_log("Falló la conexión: %s\n", mysqli_connect_error());
    die("Error connecting to DB");
}

mysqli_select_db($dbcon,"comensale");  
?>
