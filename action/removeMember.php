<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$memberId = $_POST['memberId'];

if($memberId) { 

 $sql = "UPDATE member_reg SET Status = 2 WHERE RegNo = {$memberId}";

 if($connect->query($sql) === TRUE ) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the member";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST