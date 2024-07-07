<?php 	

require_once 'core.php';

$stationId = $_POST['stationId'];

$sql = "SELECT JumuiyaCode, JumuiyaName FROM jumuiya WHERE StationCode = $stationId AND JumuiyaStatus=1";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
	while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
} // if num_rows

$connect->close();

echo json_encode($rows);



