<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$jumuiyaId = $_POST['jumuiyaId'];

if($jumuiyaId) { 

 $sql = "UPDATE jumuiya SET JumuiyaStatus = 2 WHERE JumuiyaCode = {$jumuiyaId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST