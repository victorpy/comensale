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
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css"> <!--css file link in bootstrap folder-->  
    <title>View Users</title>  
</head>  
<style>  
    .login-panel {  
        margin-top: 150px;  
    }  
    .table {  
        margin-top: 50px;  
  
    }  
  
</style>  
  
<body> 
	
<script>
	
function clickReport(){
	var month = document.getElementById('month');
	var year =  document.getElementById('year');
	var company =  document.getElementById('company');
	
	var monthStr = month.options[month.selectedIndex].value;
	var yearStr = year.options[year.selectedIndex].value;
	var companyStr = company.options[company.selectedIndex].value;
	//console.log(month.options[month.selectedIndex].value);
	
	var href = document.getElementById('reportdl');
	
	href.setAttribute('href', "downloadbymonth.php?year="+yearStr+"&month="+monthStr+"&company="+companyStr);
	
}
</script> 
  
<div class="table-scrol">  
    <br>
    <a href="welcome.php"><button class="btn btn-danger">Inicio</button></a>
    <a href="logout.php"><button class="btn btn-danger">Salir</button></a>
    
    <h1 align="center">Todos por Mes</h1><br>  
   
	 
    <div style=" display:inline-block; ">
    
		<form role="form" method="post" action="viewbymonth.php">  
				<fieldset>  				
					 <div class="form-group">
					  <label for="type">Seleccionar:</label>
					  <select class="form-control" name="month" id="month">
						<?php
						  setlocale(LC_ALL,"es_ES");
						  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
						  						  
						  for($i = 0; $i < 12; $i++){
							  printf('<option value="%s">%s</option>', $i+1, $meses[$i]);
						  }
						  
						 ?>								
					  </select>
					  
					  <select class="form-control" name="year" id="year">
						<?php
						  
						  $year = array(2018,2019,2020,2021,2022,2023,2024);						  
						  
						  for($i = 0; $i < count($year); $i++){
							  printf('<option value="%s">%s</option>', $year[$i], $year[$i]);
						  }
						  
						 ?>								
					  </select>
					  
					 <?php if($_SESSION['role'] == 'report') { ?>  

						<select class="form-control" name="company" id="company">
						<?php
						
						  include("database/db_conection.php"); 
						  $sql = "select * from company";
						  $run=mysqli_query($dbcon,$sql);//here run the sql query.  
			  
							while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
							{  								
								if($row[0] != 1){//1: admin
									printf('<option value="%s">%s</option>', $row[0], $row[1]);
								}
						    }
						  
						  
						 ?>								
					  </select>

					<?php }?>
					  
					</div> 
					
					<!--<div class="form-group">  
						<input class="form-control" placeholder="Password" name="password" type="password" value="">  
					</div>  -->


					<input class="btn btn-sm btn-success btn-block" type="submit" value="Consultar" name="report" >  

				</fieldset>  
	   </form>
	 </div>
   
   <a href="#" id="reportdl" onclick="clickReport();"><button class="btn btn-danger">Descargar</button></a>
   
  
<div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->  		  

  
			<table class="table table-bordered table-hover table-striped" style="table-layout: fixed">  
				<thead>  
		  
				<tr>  
					   
					<th>Fecha</th> 
					<th>CI</th> 
					<th>Nombre</th>  
					<th>Tipo</th>  
					
				</tr>  
				</thead>  
		  
				<?php  
				include("database/db_conection.php");  
				
				$limit = 10; 
				
				if(isset($_POST['report']))  
				{
					error_log($_POST['month']." ".$_POST['year']."\n");
					//$date = explode("-", $_POST['month']);
					
					$startLastMonth = date("Y-m-d",mktime(0, 0, 0, $_POST['month'], 1,$_POST['year']));
					$endLastMonth = date("Y-m-d",mktime(0, 0, 0, $_POST['month'] +1 , 0, $_POST['year']));
					
					//error_log(" $startLastMonth  $endLastMonth ");
					
					$company = '';
					
					if($_SESSION['role'] == 'report' || $_SESSION['role'] == 'admin'){
						$company = $_POST['company'];
					}else {
						$company = $_SESSION['company'];
					}
					
					$view_users_query="select c.ci, c.name, r.date, r.type  from comensale.registro as r, comensale.comensal as c where c.id = r.id_comensal and r.date >= '$startLastMonth' and r.date <= '$endLastMonth' and company = $company LIMIT $limit OFFSET 0 ";//select query for viewing users.  
					
					error_log(" $view_users_query ");

					error_log(" $view_users_query" );
					$run=mysqli_query($dbcon,$view_users_query);//here run the sql query.  
			  
					while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
					{  
						$date=$row[2];  
						$ci=$row[0];  
						$name=$row[1];  
						$type=$row[3];  
			  
			  
			  
					?>  
			  
					<tr>  
			<!--here showing results in the table -->  
						<td><?php echo $date;  ?></td>  
						<td><?php echo $ci;  ?></td>  
						<td><?php echo $name;  ?></td>  
						<td><?php echo $type;  ?></td>  
						
					</tr>  
			  
					<?php } 
					
					}
				?> 
				
				<?php  
				
				
				if(isset($_GET['page']))  
				{
					error_log("GET ".$_GET['startMonth']." ".$_GET['endMonth']."\n");
					//$date = explode("-", $_POST['month']);
					
					$startLastMonth = $_GET['startMonth'];
					$endLastMonth = $_GET['endMonth'];
					
					//error_log(" $startLastMonth  $endLastMonth ");
					
					$company = '';
					
					if($_SESSION['role'] == 'report' || $_SESSION['role'] == 'admin'){
						$company = $_GET['company'];
					}else {
						$company = $_SESSION['company'];
					}
					
					$view_users_query="select c.ci, c.name, r.date, r.type  from comensale.registro as r, comensale.comensal as c where c.id = r.id_comensal and r.date >= '$startLastMonth' and r.date <= '$endLastMonth' and company = $company LIMIT {$_GET['limit']} OFFSET {$_GET['offset']} ";//select query for viewing users.  
					$run=mysqli_query($dbcon,$view_users_query);//here run the sql query.  
			  
					while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
					{  
						$date=$row[2];  
						$ci=$row[0];  
						$name=$row[1];  
						$type=$row[3];  
			  		  
					?>  
			  
						<tr>  
				<!--here showing results in the table -->  
							<td><?php echo $date;  ?></td>  
							<td><?php echo $ci;  ?></td>  
							<td><?php echo $name;  ?></td>  
							<td><?php echo $type;  ?></td>  
							
						</tr>  
			  
					<?php } 
					
					}
				?>  
		  
			</table>  
			
			<?php 
			
			$sql = "select count(id) from comensale.registro as r where r.date >= '$startLastMonth' and r.date <= '$endLastMonth' and company = $company"; 
			//error_log("$sql"); 
			$rs_result = mysqli_query($dbcon,$sql);  
			$row = mysqli_fetch_row($rs_result);  
			$total_records = $row[0];
			$division = (float) ((1.0*$total_records) / (1.0*$limit));
			$total_pages = ceil((float) $total_records / (float) $limit);
			error_log("Div2 (1.0*$total_records) Tot $total_pages");  
			$pagLink = "<ul class='pagination'>";  
			//error_log("in pagination $startLastMonth  $endLastMonth ");
			for ($i=1; $i<=$total_pages; $i++) {  
						 $pagLink .= "<li><a href=viewbymonth.php?company=$company&page=$i&startMonth=".$startLastMonth."&endMonth=".$endLastMonth."&offset=".($i-1)*$limit."&limit=".$limit.">".$i."</a></li>";  
			};  
			echo $pagLink . "</ul>";  
			?>
			
        </div>  
</div>  
  

  
</body>  
  
</html>
