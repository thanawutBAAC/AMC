<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	$month_thai = array("1"=>'มกราคม',"2"=>'กุมภาพันธ์',"3"=>'มีนาคม',"4"=>'เมษายน',"5"=>'พฤษภาคม',"6"=>'มิถุนายน',"7"=>'กรกฏาคม',"8"=>'สิงหาคม',"9"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม');
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?
	include("../manu_bar.php");
?>
<!-- *********************************************************************** -->
<form name="" action="check_report.php" method="post">
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center; "> รายละเอียดการส่งข้อมูลรายงานประจำเดือน  ปีบัญชี 
<?  $temp_year =  date("Y")+525; ?>
	<select name="year">
<? WHILE($i<20) { 
	  $i++; 
	  $temp_year = $temp_year+1; ?>
	<option value="<?=$temp_year; ?>"
<? 			
		if(date("n")=='1' OR date("n")=='2' OR date("n")=='3')
			{
				if($temp_year==date("Y")+542){
					echo "selected";
				}
			}
			else{
				if($temp_year==date("Y")+543){
						echo "selected";
				}
			}  // end date ?> ><?=$temp_year; ?></option>
<?    } // end while ?>
</select>&nbsp;เดือน
<select name="month">
<?
	$month_now = date('n');
	foreach ($month_thai as $i => $m)
	 {
		if($i==$month_now)
		  	echo "<option value='$i' selected>$m</option>"; 
		else
		    echo "<option value='$i'>$m</option>";	
	 }
?>
</select>
<input type="submit" value="  แสดงข้อมูล ">
</div>
<input type="hidden" name="click" >
</form>
<!-- ********************************************************************************************** -->
<?
	if(isset($click))
	{
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
<table  width="530" align="center" class="gridtable" style="margin-top:10px;">
<tr height="30"><td colspan="4">
<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" รายงานข้อมูล " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> รายงานการส่งข้อมูลประจำเดือน <font color='red'><u><?=$month_thai[$month]?></u></font> ปีบัญชี <font color='red'><u><?=$year?></u></font> </b></center></font>
</td></tr>
<tr class="rows_pink"> 
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
		if(($i%2)==0)
			echo "<tr class='rows_grey'>";
		else
			echo "<tr>";
	?>
		<td align="center"><?=trim($fetch_report[0]) ?></td>
		<td align="left">&nbsp;<a href="check_report_detail.php?temp_amccode=<?=trim($fetch_report[4])?>&temp_name=<?=trim($fetch_report[1])?>"  ><?="สกต.".trim($fetch_report[1])?></a></td>
	
	<?	if(is_null($fetch_report[2])) {	$y++;   ?>
			<td align="center" colspan="2"><font color='red'> ไม่มีการส่งข้อมูลให้ระบบ </font></td>
	<?  }else{  $x++;   ?>
			<td align="center"><?=trim($fetch_report[2]); ?></td><td align="center"><?=trim($fetch_report[3]); ?></td>
	<?  } // end if ?>
	</tr>
<? }  // end while ?>
	<tr class='rows_blue'>
		<td colspan='2' align='center'> ส่งข้อมูล : <b><?=number_format($x,0,'','')?></b> รายการ</td>
		<td colspan='2' align='center'> ไม่ได้ส่งข้อมูล : <b><?=number_format($y,0,'','')?></b> รายการ</td>
	</tr>
</table>
<br>
<center><a href='excel_check_report.php?year=<?=$year?>&month=<?=$month?>'><img src='../images/page_excel.gif' border='0'> ข้อมูล Excel </a></center>
<?
	free_result($result_report);
	close();
	} // end if ?>
</body>
</html>
<?php
	include("../footer.php");
?>