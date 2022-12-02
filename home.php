
<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();


$sql_query = "SELECT * FROM user";
$resultset = mysqli_query($connString, $sql_query) or die("database error:". mysqli_error($conn));
$tasks = array();
while( $row = mysqli_fetch_assoc($resultset) ) {
	$tasks[] = $row;
}
if(isset($_POST["ExportType"]))
{
   
    switch($_POST["ExportType"])
    {
        case "export-to-excel" :
            // Submission from
      $filename = "phpflow_data_export_".date('Ymd') . ".xls";     
            header("Content-Type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=\"$filename\"");
      ExportFile($tasks);
      //$_POST["ExportType"] = '';
            exit();
        default :
            die("Unknown action : ".$_POST["action"]);
            break;
    }
}
function ExportFile($records) {
  $heading = false;
    if(!empty($records))
      foreach($records as $row) {
      if(!$heading) {
        // display field/column names as a first row
        echo implode("\t", array_keys($row)) . "\n";
        $heading = true;
      }
      echo implode("\t", array_values($row)) . "\n";
      }
    exit;
}
?>

