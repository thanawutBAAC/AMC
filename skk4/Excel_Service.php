<?php session_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="ข้อมูลแผนด้านบริการ.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$amc_code = $_GET['amc_code'];
	$year = $_GET['year'];

	connect();

// แสดงข้อมูลหมวดที่ 4 ของสกต ที่เลือกทั้งหมด
$sql ="	SELECT BaseReportDetail.report_detail_code,  ";
$sql.=" BaseReportDetail.report_detail_name,    ";
$sql.=" Temp01.PlanService_Apr,  ";
$sql.=" Temp01.PlanService_May,Temp01.PlanService_Jun,  ";
$sql.=" Temp01.PlanService_Jul,Temp01.PlanService_Aug,  ";
$sql.=" Temp01.PlanService_Sep,Temp01.PlanService_Oct,  ";
$sql.=" Temp01.PlanService_Nov,Temp01.PlanService_Dec,  ";
$sql.=" Temp01.PlanService_Jan,Temp01.PlanService_Feb,  ";
$sql.=" Temp01.PlanService_Mar, ";
$sql.=" Temp01.PlanService_Sum  ";
$sql.=" FROM BaseReportDetail, BaseReportHeader  ";
$sql.=" LEFT JOIN (  ";
$sql.="	SELECT   ";
$sql.="	PlanService_Apr,  ";
$sql.="	PlanService_May,PlanService_Jun,  ";
$sql.="	PlanService_Jul,PlanService_Aug,  ";
$sql.="	PlanService_Sep,PlanService_Oct,  ";
$sql.="	PlanService_Nov,PlanService_Dec,  ";
$sql.="	PlanService_Jan,PlanService_Feb,  ";
$sql.="	PlanService_Mar, ";
$sql.="	PlanService_Sum,  ";
$sql.="	report_detail_code,  ";
$sql.="	amccode,PlanService_year  ";
$sql.="	FROM PlanService  ";
$sql.="	WHERE amccode='".$amc_code."' AND PlanService_year='".$year."'  "; 
$sql.=") AS Temp01   ";
$sql.=" ON Temp01.amccode = BaseReportHeader.amccode   ";
$sql.=" AND Temp01.report_detail_code=BaseReportHeader.report_detail_code   ";
$sql.=" AND Temp01.PlanService_year = '".$year."'  "; 
$sql.=" WHERE BaseReportHeader.amccode='".$amc_code."'   ";
$sql.=" AND BaseReportHeader.report_group_code='4'    ";
$sql.=" AND BaseReportDetail.report_detail_code=BaseReportHeader.report_detail_code   ";
$sql.=" AND BaseReportDetail.report_group_code=BaseReportHeader.report_group_code   ";
$sql.=" ORDER BY BaseReportDetail.report_detail_code   ";

$result_plan =	query($sql);

?>
<html  xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:x="urn:schemas-microsoft-com:office:excel" 
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
&nbsp;
<br>
<div style="margin-left:auto; margin-right:auto; text-align: center "> รายละเอียดแผนการให้ <font color='red'>บริการและส่งเสริมการเกษตร </font> ของ สกต.  แผน สก.กก4 </div>
&nbsp;
<!-- **************************************************************************************** -->
<table  width="1260" border='1' style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr height='20'> 
		<td colspan="15" align="left">&nbsp;<font color="#0F7FAF"><b>รายละเอียดแผนการการให้บริการและส่งเสริมการเกษตรของ สกต. ปี <?=$year; ?></b></font></td>
	</tr>
 <tr bgcolor='#CC99FF'> 
    <td rowspan="2" width="20" align="center" valign="middle">ที่</td>
    <td rowspan="2" width="300" align="center" valign="middle">ประเภทการให้บริการและส่งเสริมการเกษตร</td>
    <td colspan="12" align="center">มูลค่าสินค้าที่ขายในแต่ละเดือน ( พันบาท )</td>
    <td rowspan="2" width="100" align="center">รวมทั้งหมด</td>
  </tr>
  <tr bgcolor='#CC99FF'> 
    <td width="70" align="center">เม.ย.</td>
    <td width="70" align="center">พ.ค.</td>
    <td width="70" align="center">มิ.ย.</td>
    <td width="70" align="center">ก.ค.</td>
    <td width="70" align="center">ส.ค.</td>
    <td width="70" align="center">ก.ย.</td>
    <td width="70" align="center">ต.ค.</td>
    <td width="70" align="center">พ.ย.</td>
    <td width="70" align="center">ธ.ค.</td>
    <td width="70" align="center">ม.ค.</td>
    <td width="70" align="center">ก.พ.</td>
    <td width="70" align="center">มี.ค.</td>
  </tr>
<!--  เริ่มแสดงข้อมูล  -->
<? $i=0;
	WHILE($fetch_plan =  fetch_row($result_plan)) {
	$i++;
	if(($i%2)==0)
		echo "<tr bgcolor='#C0C0C0' height='20'>";
	else
		echo "<tr height='20'>";
?>
	<td align="right"><?=$i;?>&nbsp;</td>  
	<td align="left">&nbsp;<?=trim($fetch_plan[1]); ?></td>
	<td align="right"><?=number_format($fetch_plan[2]); ?></td>
	<td align="right"><?=number_format($fetch_plan[3]); ?></td>
	<td align="right"><?=number_format($fetch_plan[4]); ?></td>
	<td align="right"><?=number_format($fetch_plan[5]); ?></td>
	<td align="right"><?=number_format($fetch_plan[6]); ?></td>
	<td align="right"><?=number_format($fetch_plan[7]); ?></td>
	<td align="right"><?=number_format($fetch_plan[8]); ?></td>
	<td align="right"><?=number_format($fetch_plan[9]); ?></td>
	<td align="right"><?=number_format($fetch_plan[10]); ?></td>
	<td align="right"><?=number_format($fetch_plan[11]); ?></td>
	<td align="right"><?=number_format($fetch_plan[12]); ?></td>
	<td align="right"><?=number_format($fetch_plan[13]); ?></td>
	<td align="right"><?=number_format($fetch_plan[14]); ?></td>
	</tr>
<? // หาผลรวมของแต่ละ colume ทั้งหมดก่อน

		$temp01=$temp01+number_format($fetch_plan[2],0,'','');	
		$temp02=$temp02+number_format($fetch_plan[3],0,'','');	
		$temp03=$temp03+number_format($fetch_plan[4],0,'','');	
		$temp04=$temp04+number_format($fetch_plan[5],0,'','');	
		$temp05=$temp05+number_format($fetch_plan[6],0,'','');	
		$temp06=$temp06+number_format($fetch_plan[7],0,'','');	
		$temp07=$temp07+number_format($fetch_plan[8],0,'','');	
		$temp08=$temp08+number_format($fetch_plan[9],0,'','');	
		$temp09=$temp09+number_format($fetch_plan[10],0,'','');	
		$temp10=$temp10+number_format($fetch_plan[11],0,'','');	
		$temp11=$temp11+number_format($fetch_plan[12],0,'','');	
		$temp12=$temp12+number_format($fetch_plan[13],0,'','');	
		$temp13=$temp13+number_format($fetch_plan[14],0,'','');	
	} // end while ?>
	<!--  แสดงข้อมูลทั้งหมดในแต่ละ colume -->
  <tr>
	<td align="center" colspan="2" bgcolor='#FFFF99' height='20'> รวม </td>  
	<td align="right"><?=number_format($temp01);?></td>
	<td align="right"><?=number_format($temp02);?></td>
	<td align="right"><?=number_format($temp03);?></td>
	<td align="right"><?=number_format($temp04);?></td>
	<td align="right"><?=number_format($temp05);?></td>
	<td align="right"><?=number_format($temp06);?></td>
	<td align="right"><?=number_format($temp07);?></td>
	<td align="right"><?=number_format($temp08);?></td>
	<td align="right"><?=number_format($temp09);?></td>
	<td align="right"><?=number_format($temp10);?></td>
	<td align="right"><?=number_format($temp11);?></td>
	<td align="right"><?=number_format($temp12);?></td>
	<td align="right"><?=number_format($temp13);?></td>
	</tr>
<!-- ************************************************************************* -->
</table>
<br>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
?>