<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$accId = $_POST['accId'];

if($accId) { 

 $sql = "UPDATE church_acc SET Accnt_active = 2 WHERE AccntCode = {$accId}";

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