<?php session_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="ข้อมูลแผนสมาชิกและทุนเรือนหุ้น.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	
	$amc_code = $_GET['amc_code'];
	$year = $_GET['year'];

	// แสดงข้อมูลการรับสมาชิกและเพิ่มทุนเรือนหุ้น
	$sql=" SELECT userlogin.amccode,  ";
	$sql.=" Temp01.MemFirstQuarter,Temp01.MemSecondQuarter, ";
	$sql.=" Temp01.MemThirdQuarter,Temp01.MemFourthQuarter, ";
	$sql.=" Temp01.MemSumYear ";
	$sql.=" FROM  userlogin  ";
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT  ";
	$sql.=" amccode,MemFirstQuarter, ";
	$sql.="  MemSecondQuarter, MemThirdQuarter, ";
	$sql.="  MemFourthQuarter,MemSumYear  ";
	$sql.=" FROM PlanMember  ";
	$sql.=" WHERE PlanMember_year='".$year."'  ";
	$sql.=" ) AS Temp01 ON Temp01.amccode = userlogin.amccode ";
	$sql.=" WHERE userlogin.amccode='".$amc_code."' ";

	$result_plan =	query($sql);

//*****************************
	$year3=$year-3;
	$year2=$year-2;
	$year1=$year-1;
	$sql=" SELECT ";
	$sql.=" ans1 = ( SELECT MemSumYear FROM PlanMember WHERE PlanMember_year='".$year3."' AND amccode='".$amc_code."' ), ";
	$sql.=" ans2 = ( SELECT MemSumYear FROM PlanMember WHERE PlanMember_year='".$year2."' AND amccode='".$amc_code."' ), ";
	$sql.=" ans3 = ( SELECT MemSumYear FROM PlanMember WHERE PlanMember_year='".$year1."' AND amccode='".$amc_code."' ), ";
	$sql.=" ans4 = ( SELECT ShareSumYear FROM PlanMember WHERE PlanMember_year='".$year3."' AND amccode='".$amc_code."' ), ";
	$sql.=" ans5 = ( SELECT ShareSumYear FROM PlanMember WHERE PlanMember_year='".$year2."' AND amccode='".$amc_code."' ), ";
	$sql.=" ans6 = ( SELECT ShareSumYear FROM PlanMember WHERE PlanMember_year='".$year1."' AND amccode='".$amc_code."' ) ";
	$sql.=" FROM PlanMember ";
	$result_member= query($sql);
	if($result_member)
	{	
		if(num_rows($result_member)==0){
			$ans1=0;
			$ans2=0;
			$ans3=0;
			$ans4=0;
			$ans5=0;
			$ans6=0;
		}
		else{
			$ans1= number_format(result($result_member,'0','ans1'),0,'','');
			$ans2= number_format(result($result_member,'0','ans2'),0,'','');
			$ans3= number_format(result($result_member,'0','ans3'),0,'','');
			$ans4= number_format(result($result_member,'0','ans4'),0,'','');
			$ans5= number_format(result($result_member,'0','ans5'),0,'','');
			$ans6= number_format(result($result_member,'0','ans6'),0,'','');
		}
   } // end if
?>
<html  xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:x="urn:schemas-microsoft-com:office:excel" 
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
<br>
&nbsp;
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center "> แผนการดำเนินงานด้าน <font color='red'>สมาชิกและทุนเรือนหุ้น </font></div>
&nbsp;
<table  width="1050" border='1' style="margin-left:5px; margin-right:5px; margin-top:10px;">
<tr height='20'> 
	<td colspan="10" align="left">&nbsp;<font color="#0F7FAF"><b>รายละเอียดแผนการรับสมาชิกและเพิ่มทุนเรือนหุ้นของ สกต. ปี <?=$year; ?></b></font></td>
</tr>
 <tr bgcolor='#FFCC00' height='20'> 
    <td rowspan="2" width="20" align="center" valign="middle">ที่</td>
    <td rowspan="2" width="300" align="center" valign="middle">แผนงาน</td>
    <td colspan="3" width="" align="center" valign="middle">ผลงานย้อนหลัง</td>
    <td colspan="5" align="center" valign="middle">เป้าหมายงานประจำปี</td>
  </tr>
  <tr bgcolor='#FFCC00' height='20'> 
    <td align="center" width="90" align="center"><?=$year-3?></td>
    <td align="center" width="90" align="center"><?=$year-2?></td>
	<td align="center" width="90" align="center"><?=$year-1?></td>
    <td align="center" width="90" align="center">ไตรมาส 1</td>
    <td align="center" width="90" align="center">ไตรมาส 2</td>
	<td align="center" width="90" align="center">ไตรมาส 3</td>
    <td align="center" width="90" align="center">ไตรมาส 4</td>
    <td align="center" width="100" align="center">รวมทั้งสิ้น</td>
  </tr>
<!--  เริ่มแสดงข้อมูล  -->
<? 
	WHILE($fetch_plan =  fetch_row($result_plan)) {
?>
  <tr height='20'>
	<td align="right">1&nbsp;</td>  
	<td align="left">&nbsp;การรับสมาชิก</td>
	<td align="center"><?=$ans1 ?></td>
	<td align="center"><?=$ans2 ?></td>
	<td align="center"><?=$ans3 ?></td>
	<td align="right"><?=number_format($fetch_plan[1]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[2]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[3]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[4]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[5]); ?>&nbsp;</td>
  </tr>
<?  } // end while 

// แสดงข้อมูลการเพิ่มทุนเรือนหุ้น
$sql=" SELECT userlogin.amccode,  ";
$sql.=" Temp01.ShareFirstQuarter,  Temp01.ShareSecondQuarter, ";
$sql.=" Temp01.ShareThirdQuarter, Temp01.ShareFourthQuarter, ";
$sql.=" Temp01.ShareSumYear ";
$sql.=" FROM  userlogin  ";
$sql.=" LEFT JOIN ( ";
$sql.=" SELECT  ";
$sql.=" amccode, ShareFirstQuarter, ";
$sql.="  ShareSecondQuarter, ShareThirdQuarter, ";
$sql.="  ShareFourthQuarter,ShareSumYear  ";
$sql.=" FROM PlanMember  ";
$sql.=" WHERE PlanMember_year='".$year."'  ";
$sql.=" ) AS Temp01 ON Temp01.amccode = userlogin.amccode ";
$sql.=" WHERE userlogin.amccode='".$amc_code."' ";
$result_plan =	query($sql); 
WHILE($fetch_plan =  fetch_row($result_plan)) { ?>
  <tr bgcolor='#C0C0C0' height='20'>
	<td align="right">2&nbsp;</td>  
	<td align="left">&nbsp;การเพิ่มทุนเรือนหุ้น ( หน่วย : พันบาท)</td>
	<td align="center"><?=$ans4 ?></td>
	<td align="center"><?=$ans5 ?></td>
	<td align="center"><?=$ans6 ?></td>
	<td align="right"><?=number_format($fetch_plan[1]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[2]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[3]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[4]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[5]); ?>&nbsp;</td>
</tr>
<? } // end while ?>
</table>
</body>
</html>
<?php
	free_result($result_plan);
	close();
?>