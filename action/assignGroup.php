<?php 	

require_once 'core.php';

$groupId = $_POST['membGroup'];
$membId = $_POST['selMemb'];

$valid['success'] = array('success' => false, 'messages' => array());
$result ='';

foreach($membId AS $Moja){
	$Qry = "SELCT * FROM member_group WHERE RegNo='$Moja' AND GroupCode='$groupId'";
	$Rstl = $connect->query($Qry);
	if($Rstl->num-rows>0){	}else{
		$sql = "INSERT INTO member_group (GroupCode,RegNo,Status_m,Jdate) VALUES ('$groupId','$Moja',1,NOW())";
		$result = $connect->query($sql);
	}
}

	if($result === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the members";
	}	

	$connect->close();

	echo json_encode($valid);
 
?>