<?php 	

require_once 'core.php';

$accId = $_POST['accId'];

$sql = "SELECT AccntCode, AccntName, Accnt_active FROM church_acc WHERE AccntCode = '$accId'";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);



