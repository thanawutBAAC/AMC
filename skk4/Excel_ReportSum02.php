<?php session_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="ข้อมูลแผนสมาชิกและทุนเรือนหุ้น.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
		$div = $_GET['div'];
	$year = $_GET['year'];

// แสดงข้อมูลการรับสมาชิกและเพิ่มทุนเรือนหุ้น
$sql =" SELECT ";
$sql.=" SUM(PlanMember.MemFirstQuarter) AS MemFirstQuarter, ";
$sql.=" SUM(PlanMember.MemSecondQuarter) AS MemSecondQuarter, ";
$sql.=" SUM(PlanMember.MemThirdQuarter) AS MemThirdQuarter, ";
$sql.=" SUM(PlanMember.MemFourthQuarter) AS MemFourthQuarter, ";
$sql.=" MemSumYear ";
$sql.=" FROM PlanMember ,userlogin ";
$sql.=" WHERE PlanMember.PlanMember_year='".$year."' ";
if($div!=0)
{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
$sql.=" AND PlanMember.amccode = userlogin.amccode ";
$sql.=" AND userlogin.status ='N' ";
$sql.=" GROUP BY MemSumYear ";

$result_plan =	query($sql);

//*****************************
	$year3=$year-3;
	$year2=$year-2;
	$year1=$year-1;
	$sql=" SELECT ";
	$sql.=" ans1 = (  SELECT SUM(MemSumYear)  FROM PlanMember, userlogin  WHERE PlanMember_year='".$year3."' 
	AND userlogin.amccode = PlanMember.amccode  AND userlogin.status='N' ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" ), ";
	$sql.=" ans2 = (  SELECT SUM(MemSumYear)  FROM PlanMember, userlogin  WHERE PlanMember_year='".$year2."' 
	AND userlogin.amccode = PlanMember.amccode  AND userlogin.status='N' ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" ), ";
	$sql.=" ans3 = (  SELECT SUM(MemSumYear)  FROM PlanMember, userlogin  WHERE PlanMember_year='".$year1."' 
	AND userlogin.amccode = PlanMember.amccode  AND userlogin.status='N' ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" ), ";
	$sql.=" ans4 = (  SELECT SUM(ShareSumYear)  FROM PlanMember, userlogin  WHERE PlanMember_year='".$year3."' 
	AND userlogin.amccode = PlanMember.amccode  AND userlogin.status='N' ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" ), ";
	$sql.=" ans5 = (  SELECT SUM(ShareSumYear)  FROM PlanMember, userlogin  WHERE PlanMember_year='".$year2."' 
	AND userlogin.amccode = PlanMember.amccode  AND userlogin.status='N' ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" ), ";
	$sql.=" ans6 = (  SELECT SUM(ShareSumYear)  FROM PlanMember, userlogin  WHERE PlanMember_year='".$year1."' 
	AND userlogin.amccode = PlanMember.amccode  AND userlogin.status='N' ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" ) ";

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
	<td colspan="10" align="left">&nbsp;<font color="#0F7FAF"><b>ภาพรวมแผนการรับสมาชิกและเพิ่มทุนเรือนหุ้นของ สกต. ปี <?=$year; ?></b></font></td>
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
	<td align="right"><?=number_format($fetch_plan[0]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[1]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[2]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[3]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[4]); ?>&nbsp;</td>
  </tr>
<?  } // end while 

// แสดงข้อมูลการเพิ่มทุนเรือนหุ้น
$sql =" SELECT  ";
$sql.=" SUM(ShareFirstQuarter),   ";
$sql.=" SUM(ShareSecondQuarter),   ";
$sql.=" SUM(ShareThirdQuarter),   ";
$sql.=" SUM(ShareFourthQuarter),  ";
$sql.=" SUM(ShareSumYear)   ";
$sql.=" FROM PlanMember,userlogin   ";
$sql.=" WHERE userlogin.amccode = PlanMember.amccode  ";
$sql.=" AND PlanMember_year='".$year."'   ";
if($div!=0)
{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
$sql.=" AND userlogin.status = 'N'  ";
$sql.=" GROUP BY PlanMember_year  ";
$result_plan =	query($sql); 
WHILE($fetch_plan =  fetch_row($result_plan)) { ?>
  <tr bgcolor='#C0C0C0' height='20'>
	<td align="right">2&nbsp;</td>  
	<td align="left">&nbsp;การเพิ่มทุนเรือนหุ้น ( หน่วย : พันบาท)</td>
	<td align="center"><?=$ans4 ?></td>
	<td align="center"><?=$ans5 ?></td>
	<td align="center"><?=$ans6 ?></td>
	<td align="right"><?=number_format($fetch_plan[0]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[1]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[2]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[3]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[4]); ?>&nbsp;</td>
</tr>
<? } // end while ?>
</table>
</body>
</html>
<?php
	free_result($result_plan);
	close();
?>