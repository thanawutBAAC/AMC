<?php session_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="รายละเอียดการส่งข้อมูลรายงานประจำเดือน.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");
	$month_thai = array("1"=>'มกราคม',"2"=>'กุมภาพันธ์',"3"=>'มีนาคม',"4"=>'เมษายน',"5"=>'พฤษภาคม',"6"=>'มิถุนายน',"7"=>'กรกฏาคม',"8"=>'สิงหาคม',"9"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม');
?>
<html  xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:x="urn:schemas-microsoft-com:office:excel" 
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title>รายละเอียดการส่งข้อมูลรายงานประจำเดือน </title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
<!-- ********************************************************************************************** -->
<?
		connect();	
		$sql = " SELECT userlogin.br_code, AMC.AMCName, Temp01.sent_date,Temp01.sent_time, userlogin.amccode ";
		$sql.=" FROM userlogin,AMC ";
		$sql.=" LEFT JOIN( ";
		$sql.=" SELECT amccode ,sent_date,sent_time ";
		$sql.=" FROM SentReportHeader ";
		$sql.=" WHERE sent_month='".$month."' AND sent_year='".$year."' ) ";
		$sql.=" AS Temp01 ON Temp01.amccode = AMC.amccode  ";
		$sql.=" WHERE userlogin.AMCCode = AMC.AMCCode ";
		$sql.=" ORDER BY userlogin.br_code, AMC.amcprovince ";

?>
<table  border='1'>
<tr height="30"><td colspan="4">
<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" รายงานข้อมูล " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> รายงานการส่งข้อมูลประจำเดือน <font color='red'><u><?=$month_thai[$month]?></u></font> ปี <font color='red'><u><?=$year?></u></font> </b></center></font>
</td></tr>
<tr bgcolor='#FFCCFF'> 
	<td valign="middle" align="center" width="50">ฝ่าย</td>
	<td valign="middle" align="center" width="180"> สกต. </td>
	<td valign="middle" align="center" width="150"> วันที่ส่ง </td>
	<td valign="middle" align="center" width="150"> เวลาที่ส่ง </td>
</tr>
<? 
	$result_report =  query($sql);
	$i=0;
	$x = 0;    // ส่งข้อมูล
	$y = 0;    // ไม่ส่งข้อมูล
	WHILE( $fetch_report = fetch_row($result_report))
	{  $i++;
	?>
	<tr>
		<td align="center"><?=trim($fetch_report[0]) ?></td>
		<td align="left">&nbsp;<?="สกต.".trim($fetch_report[1])?></a></td>
	<?	if(is_null($fetch_report[2])) {	$y++;   ?>
			<td align="center" colspan="2"><font color='red'> ไม่มีการส่งข้อมูลให้ระบบ </font></td>
	<?  }else{  $x++;   ?>
			<td align="center"><?=trim($fetch_report[2]); ?></td><td align="center"><?=trim($fetch_report[3]); ?></td>
	<?  } // end if ?>
	</tr>
<? }  // end while ?>
	<tr bgcolor='#0066FF'>
		<td colspan='2' align='center'> ส่งข้อมูล : <b><?=number_format($x,0,'','')?></b> รายการ</td>
		<td colspan='2' align='center'> ไม่ได้ส่งข้อมูล : <b><?=number_format($y,0,'','')?></b> รายการ</td>
	</tr>
</table>
<?
	free_result($result_report);
	close();
?>
</body>
</html>