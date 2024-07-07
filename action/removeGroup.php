<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$stationId = $_POST['stationId'];

if($stationId) { 

 $sql = "UPDATE church_group SET Group_active = 2 WHERE GroupCode = {$stationId}";

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