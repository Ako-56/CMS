<?php 	

require_once 'core.php';

$stationId = $_POST['stationId'];

$sql = "SELECT StationCode, StationName, Station_active FROM parish_station WHERE StationCode = $brandId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);



