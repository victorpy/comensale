<?php 

include("database/db_conection.php");  

error_log($_SESSION['email']);

function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}

$startLastMonth = date("Y-m-d",mktime(0, 0, 0, $_GET['month'], 1,$_GET['year']));
$endLastMonth = date("Y-m-d",mktime(0, 0, 0, $_GET['month'] +1 , 0, $_GET['year']));
$company = $_GET['company'];


$result = mysqli_query($dbcon,"select c.ci, c.name, r.date, r.type, r.amount  from comensale.registro as r, comensale.comensal as c where c.id = r.id_comensal and r.company = $company and r.date >= '$startLastMonth' and r.date <= '$endLastMonth'");
if (!$result) die('Couldn\'t fetch records');
$num_fields = mysqli_num_fields($result);
$headers = array();
for ($i = 0; $i < $num_fields; $i++) {
    $headers[] = mysqli_field_name($result , $i);
}

$rand = substr(md5(microtime()),rand(0,26),5);

$fp = fopen('php://output', 'w');
if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="report-'.$rand.'.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}

?>
