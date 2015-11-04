<?php session_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="ข้อมูลแผนด้านการแปรรูปผลผลิต ด้านการขาย.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$amc_code = $_GET['amc_code'];
	$year = $_GET['year'];

	connect();

// แสดงข้อมูลหมวดที่ 8 ของสกต ที่เลือกทั้งหมด
$sql ="	SELECT BaseReportDetail.report_detail_code,  ";
$sql.=" BaseReportDetail.report_detail_name,    ";
$sql.=" BaseReportDetail.report_detail_unit,  ";
$sql.=" Temp01.PlanTransSell_price,Temp01.PlanTransSell_Apr,  ";
$sql.=" Temp01.PlanTransSell_May,Temp01.PlanTransSell_Jun,  ";
$sql.=" Temp01.PlanTransSell_Jul,Temp01.PlanTransSell_Aug,  ";
$sql.=" Temp01.PlanTransSell_Sep,Temp01.PlanTransSell_Oct,  ";
$sql.=" Temp01.PlanTransSell_Nov,Temp01.PlanTransSell_Dec,  ";
$sql.=" Temp01.PlanTransSell_Jan,Temp01.PlanTransSell_Feb,  ";
$sql.=" Temp01.PlanTransSell_Mar,Temp01.PlanTransSell_Unit,  ";
$sql.=" Temp01.PlanTransSell_Sum  ";
$sql.=" FROM BaseReportDetail, BaseReportHeader  ";
$sql.=" LEFT JOIN (  ";
$sql.="	SELECT   ";
$sql.="	PlanTransSell_price,PlanTransSell_Apr,  ";
$sql.="	PlanTransSell_May,PlanTransSell_Jun,  ";
$sql.="	PlanTransSell_Jul,PlanTransSell_Aug,  ";
$sql.="	PlanTransSell_Sep,PlanTransSell_Oct,  ";
$sql.="	PlanTransSell_Nov,PlanTransSell_Dec,  ";
$sql.="	PlanTransSell_Jan,PlanTransSell_Feb,  ";
$sql.="	PlanTransSell_Mar,PlanTransSell_Unit,  ";
$sql.="	PlanTransSell_Sum,  ";
$sql.="	report_detail_code,  ";
$sql.="	amccode,PlanTransSell_year  ";
$sql.="	FROM PlanTransSell  ";
$sql.="	WHERE amccode='".$amc_code."' AND ";
$sql.=" PlanTransSell_year='".$year."') AS Temp01 "; 
$sql.=" ON Temp01.amccode = BaseReportHeader.amccode  ";
$sql.=" AND Temp01.report_detail_code=BaseReportHeader.report_detail_code  ";
$sql.=" AND Temp01.PlanTransSell_year = '".$year."'  "; 
$sql.=" WHERE BaseReportHeader.amccode='".$amc_code."'  ";
$sql.=" AND BaseReportHeader.report_group_code='8'    ";
$sql.=" AND BaseReportDetail.report_detail_code=BaseReportHeader.report_detail_code   ";
$sql.=" AND BaseReportDetail.report_group_code=BaseReportHeader.report_group_code   ";
$sql.=" ORDER BY BaseReportDetail.report_detail_code  ";

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
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center "> รายละเอียดแผนการแปรรูปผลผลิตการเกษตรของ สกต. <font color='red'>(ยอดขาย)</font> แผน สก.กก4 </div>
<!-- ******************************************************************************************************************************************** -->
&nbsp;
<table  width="1440" border='1' >
<tr height='20'> 
	<td colspan="18" align="left">&nbsp;<font color="#0F7FAF"><b>รายละเอียดแผนการแปรรูปผลผลิตมาจำหน่ายของ สกต. ปี <?=$year; ?></b></font></td>
</tr>
 <tr bgcolor='#33CCCC' height='20'> 
    <td rowspan="2" width="20" align="center" valign="middle">ที่</td>
    <td rowspan="2" width="300" align="center" valign="middle">ประเภทผลผลิต</td>
    <td rowspan="2" width="50" align="center" valign="middle">หน่วยนับ</td>
    <td rowspan="2" width="80" align="center" valign="middle">ราคาต่อหน่วย<br>(บาท)</td>
    <td colspan="12" align="center">มูลค่าผลผลิตที่ขายในแต่ละเดือน ( พันบาท )</td>
    <td colspan="2" align="center">รวมทั้งหมด</td>
  </tr>
  <tr bgcolor='#33CCCC'> 
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
    <td width="75" align="center">จำหน่วย<br>หน่วย</td>
    <td width="75" align="center">จำนวนเงิน<br>(พันบาท)</td>
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
	<td align="center"><?=trim($fetch_plan[2]); ?></td>
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
	<td align="right"><?=number_format($fetch_plan[15]); ?></td>
	<td align="right"><?=number_format($fetch_plan[16]); ?></td>
	<td align="right"><?=number_format($fetch_plan[17]); ?></td>
	</tr>
<? // หาผลรวมของแต่ละ colume ทั้งหมดก่อน
		$temp01=$temp01+number_format($fetch_plan[3],0,'','');	
		$temp02=$temp02+number_format($fetch_plan[4],0,'','');	
		$temp03=$temp03+number_format($fetch_plan[5],0,'','');	
		$temp04=$temp04+number_format($fetch_plan[6],0,'','');	
		$temp05=$temp05+number_format($fetch_plan[7],0,'','');	
		$temp06=$temp06+number_format($fetch_plan[8],0,'','');	
		$temp07=$temp07+number_format($fetch_plan[9],0,'','');	
		$temp08=$temp08+number_format($fetch_plan[10],0,'','');	
		$temp09=$temp09+number_format($fetch_plan[11],0,'','');	
		$temp10=$temp10+number_format($fetch_plan[12],0,'','');	
		$temp11=$temp11+number_format($fetch_plan[13],0,'','');	
		$temp12=$temp12+number_format($fetch_plan[14],0,'','');	
		$temp13=$temp13+number_format($fetch_plan[15],0,'','');	
		$temp14=$temp14+number_format($fetch_plan[16],0,'','');	
		$temp15=$temp15+number_format($fetch_plan[17],0,'','');	
	} // end while ?>
	<!--  แสดงข้อมูลทั้งหมดในแต่ละ colume -->
  <tr>
	<td align="center" colspan="3" bgcolor='#FFFF99' height='20'><strong> รวม </strong></td>  
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
	<td align="right"><?=number_format($temp14);?></td>
	<td align="right"><?=number_format($temp15);?></td>
</tr>
<!-- ***************************************************************************************************************************************** -->
</table>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
?>