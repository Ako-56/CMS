<?php 	

require_once 'core.php';

$RegNo = $_POST['RegNo'];

$valid = array('member' => array(), 'member_i' => array());

$sql = "SELECT member_reg.RegNo,member_reg.Savedate,member_reg.Name,member_reg.CellNo,member_reg.Gender,
parish_station.StationCode,jumuiya.JumuiyaCode,member_reg.Status,member_reg.CreatedBy
FROM member_reg 
INNER JOIN parish_station ON member_reg.StationCode=parish_station.StationCode
INNER JOIN jumuiya ON member_reg.JumuiyaCode=jumuiya.JumuiyaCode
WHERE orders.order_id = {$orderId} AND Status=1";

$result = $connect->query($sql);
$data = $result->fetch_row();
$valid['member'] = $data;


$connect->close();

echo json_encode($valid);