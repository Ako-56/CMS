<?php    

require_once 'core.php';

$RegNo = $_POST['memberId'];

$sql = "SELECT member_reg.RegNo,member_reg.Savedate,member_reg.Name,member_reg.CellNo,member_reg.Gender,
parish_station.StationName,jumuiya.JumuiyaName,member_reg.Status,member_reg.CreatedBy
FROM member_reg 
INNER JOIN parish_station ON member_reg.StationCode=parish_station.StationCode
INNER JOIN jumuiya ON member_reg.JumuiyaCode=jumuiya.JumuiyaCode
WHERE member_reg.RegNo = {$RegNo} AND Status=1";

$Result = $connect->query($sql);
$memberData = $Result->fetch_array();

$memberReg = $memberData[0];
$memberDate = $memberData[1];
$memberName = $memberData[2];
$memberContact = $memberData[3]; 
$memberGender = $memberData[4];
$memberStation = $memberData[5];
$memberJumuiya = $memberData[6]; 

 $table = '<style>
.star img {
    visibility: visible;
}</style>
<table align="center" cellpadding="0" cellspacing="0" style="width: 90%;">
   <tbody>
	  <tr>
		 <td colspan="5" style="text-align:center;color: red;text-decoration: underline; font-size: 25px;">REGISTRATION FORM</td>
	  </tr>
	  <tr>
		 <td colspan="5" style="text-align:center;color: red;text-decoration: underline; font-size: 25px;">ST. ALEX CATHOLIC CHURCH</td>
	  </tr>
	  <tr>
		 <td rowspan="6" colspan="2" style="border-left:1px solid black;"><img src="assets/images/logo.jpg" alt="logo" width="200px;"></td>
		 <td colspan="3" style=" text-align: right;">ORIGINAL</td>
	  </tr>
	  <tr>
		 <td colspan="3" style=" text-align: right;font-style: italic;">ST. ALEX CATHOLIC CHURCH</td>
	  </tr>
	  <tr>
		 <td colspan="3" style=" text-align: right;">PO. BOX 931-10967</td>
	  </tr>
	  <tr>
		 <td colspan="3" style=" text-align: right;">Tala</td>
	  </tr>
	  <tr>
		 <td colspan="3" style=" text-align: right;">Tell: 1234567890,1478523690.</td>
	  </tr>
	  <tr>
		 <td colspan="3" style=" text-align: right;">Email: email@email.co.in</td>
	  </tr>
	  <tr>
		<td>Reg. No.:</td>
		<td colspan="4"style="border-bottom:dotted black;">'.$memberReg.'</td>
	  </tr>
	  <tr>
		<td>Name:</td>
		<td colspan="4"style="border-bottom:dotted black;">'.$memberName.'</td>
	  </tr>	  
	  <tr>                                                   
		<td>Gender:</td>                                     
		<td colspan="4"style="border-bottom:dotted black;">'.$memberGender.'</td>
	  </tr>                                                  
	  <tr>                                                   
		<td>Contact:</td>
		<td colspan="4"style="border-bottom:dotted black;">'.$memberContact.'</td>
	  </tr>
	  <tr>
	    <td>Outstation:</td>
		<td colspan="4"style="border-bottom:dotted black;">'.$memberStation.'</td>
	  </tr>
	  <tr>
		<td>Jumuiya:</td>
		<td colspan="4"style="border-bottom:dotted black;">'.$memberJumuiya.'</td>
	  </tr>
	  <tr>
		<td>Join Date:</td>
		<td colspan="2"style="border-bottom:dotted black;">'.$memberDate.'</td>
	  </tr>
	  <tr>
		<td style="border-bottom: 1px solid black;">Sign:<br/></td>
		<td colspan="4"style="border-bottom: 1px solid black;"></td>
	  </tr>
	  <tr>
		<td colspan="4">
			Father In-Charge<br/><br/><br/>Alex Cosset<br/>Date:
		</td>
		<td style="text-align:center"></td>
	  </tr>  
   </tbody>
</table>';
$connect->close();

echo $table;