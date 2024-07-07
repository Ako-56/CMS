<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$stationId = $_POST['stationId'];

if($stationId) { 

 $sql = "UPDATE parish_station SET Station_active = 2 WHERE StationCode = {$brandId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while removing the station";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST