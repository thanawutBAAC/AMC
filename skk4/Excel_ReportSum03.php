<?php session_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="ภาพรวมข้อมูลแผนด้านการจัดหาสินค้า ด้านการซื้อ.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$div = $_GET['div'];
	$year = $_GET['year'];

	connect();

// แสดงข้อมูลหมวดที่ 2 ของสกต ที่เลือกทั้งหมด
$sql = " SELECT BaseReportDetail.report_detail_code, ";
$sql.=" BaseReportDetail.report_detail_name,  ";
$sql.=" BaseReportDetail.report_detail_unit,  ";
$sql.=" Temp01.Imports_unit,Temp01.Imports_price,  ";
$sql.=" Temp01.PlanProcureBuy_price,Temp01.PlanProcureBuy_Apr,  ";
$sql.=" Temp01.PlanProcureBuy_May,Temp01.PlanProcureBuy_Jun,  ";
$sql.=" Temp01.PlanProcureBuy_Jul,Temp01.PlanProcureBuy_Aug, ";
$sql.=" Temp01.PlanProcureBuy_Sep,Temp01.PlanProcureBuy_Oct,  ";
$sql.=" Temp01.PlanProcureBuy_Nov,Temp01.PlanProcureBuy_Dec,  ";
$sql.=" Temp01.PlanProcureBuy_Jan,Temp01.PlanProcureBuy_Feb,  ";
$sql.=" Temp01.PlanProcureBuy_Mar,Temp01.PlanProcureBuy_Unit,  ";
$sql.=" Temp01.PlanProcureBuy_Sum,Temp01.PlanProcureBuy_Unit_year,  ";
$sql.=" Temp01.PlanProcureBuy_Sum_year  ";
$sql.=" FROM BaseReportDetail  ";
$sql.=" LEFT JOIN (  ";
$sql.=" SELECT  ";
$sql.=" SUM(PlanProcureBuy.Imports_unit) AS Imports_unit, ";
$sql.=" SUM(PlanProcureBuy.Imports_price) AS Imports_price,  ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_price) AS PlanProcureBuy_price, ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Apr) AS PlanProcureBuy_Apr,  ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_May) AS PlanProcureBuy_May, ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Jun) AS PlanProcureBuy_Jun,  ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Jul) AS PlanProcureBuy_Jul, ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Aug) AS PlanProcureBuy_Aug,  ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Sep) AS PlanProcureBuy_Sep, ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Oct) AS PlanProcureBuy_Oct,  ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Nov) AS PlanProcureBuy_Nov, ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Dec) AS PlanProcureBuy_Dec,  ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Jan) AS PlanProcureBuy_Jan, ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Feb) AS PlanProcureBuy_Feb,  ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Mar) AS PlanProcureBuy_Mar, ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Unit) AS PlanProcureBuy_Unit,  ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Sum) AS PlanProcureBuy_Sum, ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Unit_year) AS PlanProcureBuy_Unit_year,  ";
$sql.=" SUM(PlanProcureBuy.PlanProcureBuy_Sum_year) AS PlanProcureBuy_Sum_year, ";
$sql.=" PlanProcureBuy.report_detail_code ";

$sql.=" FROM PlanProcureBuy ,userlogin ";
$sql.=" WHERE PlanProcureBuy.amccode = userlogin.amccode ";
$sql.=" AND userlogin.status = 'N' ";
$sql.=" AND PlanProcureBuy_year='".$year."' ";
if($div!=0)
{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
$sql.=" GROUP BY PlanProcureBuy.report_detail_code ) AS Temp01  ";
$sql.=" ON Temp01.report_detail_code=BaseReportDetail.report_detail_code  ";

$sql.=" WHERE  BaseReportDetail.report_group_code='2'  ";
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
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center "> ภาพรวมแผนการจัดหาสินค้ามาจำหน่ายของ สกต. <font color='red'>(ยอดซื้อ)</font>  แผน สก.กก4 </div>
&nbsp;
<!-- สิ้นสุดการแสดงปี -->
<table  width="1700" border='1' style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="22" align="left">&nbsp;<font color="#0F7FAF"><b>รายละเอียดแผนการจัดหาสินค้ามาจำหน่ายของ สกต. ปี <?=$year; ?></b></font></td>
	</tr>
 <tr bgcolor='#CCFFCC' height='20'> 
    <td rowspan="3" width="20" align="center" valign="middle">ที่</td>
    <td rowspan="3" width="300" align="center" valign="middle">ประเภทสินค้า</td>
    <td rowspan="3" width="50" align="center" valign="middle">หน่วยนับ</td>
    <td colspan="2" align="center">สินค้าคงเหลือยกมาต้นปี</td>
    <td rowspan="3" width="80" align="center" valign="middle">ราคาต่อหน่วย<br>(บาท)</td>
    <td colspan="14" align="center">มูลค่าสินค้าที่ซื้อในแต่ละเดือน ( พันบาท )</td>
    <td colspan="2" align="center">รวมสินค้าทั้งหมดที่มีจำหน่าย</td>
  </tr>
  <tr bgcolor='#CCFFCC'> 
    <td rowspan="2" width="70" align="center">จำนวน<br>หน่วย</td>
    <td rowspan="2" width="70" align="center">จำนวนเงิน<br>(พันบาท)</td>
    <td rowspan="2" width="70" align="center">เม.ย.</td>
    <td rowspan="2" width="70" align="center">พ.ค.</td>
    <td rowspan="2" width="70" align="center">มิ.ย.</td>
    <td rowspan="2" width="70" align="center">ก.ค.</td>
    <td rowspan="2" width="70" align="center">ส.ค.</td>
    <td rowspan="2" width="70" align="center">ก.ย.</td>
    <td rowspan="2" width="70" align="center">ต.ค.</td>
    <td rowspan="2" width="70" align="center">พ.ย.</td>
    <td rowspan="2" width="70" align="center">ธ.ค.</td>
    <td rowspan="2" width="70" align="center">ม.ค.</td>
    <td rowspan="2" width="70" align="center">ก.พ.</td>
    <td rowspan="2" width="70" align="center">มี.ค.</td>
    <td colspan="2" align="center">รวมทั้งหมด</td>
    <td rowspan="2" width="75" align="center">จำหน่วย<br>หน่วย</td>
    <td rowspan="2" width="75" align="center">จำนวนเงิน<br>(พันบาท)</td>
  </tr>
  <tr bgcolor='#CCFFCC' height='20'> 
    <td align="center" width="50" align="center">หน่วย</td>
    <td align="center" width="70" align="center">จำนวนเงิน</td>
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
	<td align="right"><?=number_format($fetch_plan[3]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[4]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[5]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[6]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[7]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[8]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[9]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[10]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[11]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[12]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[13]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[14]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[15]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[16]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[17]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[18]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[19]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[20]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[21]); ?>&nbsp;</td>
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
		$temp16=$temp16+number_format($fetch_plan[18],0,'','');	
		$temp17=$temp17+number_format($fetch_plan[19],0,'','');	
		$temp18=$temp18+number_format($fetch_plan[20],0,'','');	
		$temp19=$temp19+number_format($fetch_plan[21],0,'','');	
} // end while ?>
	<!--  แสดงข้อมูลทั้งหมดในแต่ละ colume -->
  <tr>
	<td align="center" colspan="3" bgcolor='#FFFF99' height='20'><strong> รวม </strong></td>  
	<td align="right"><?=number_format($temp01);?>&nbsp;</td>
	<td align="right"><?=number_format($temp02);?>&nbsp;</td>
	<td align="right"><?=number_format($temp03);?>&nbsp;</td>
	<td align="right"><?=number_format($temp04);?>&nbsp;</td>
	<td align="right"><?=number_format($temp05);?>&nbsp;</td>
	<td align="right"><?=number_format($temp06);?>&nbsp;</td>
	<td align="right"><?=number_format($temp07);?>&nbsp;</td>
	<td align="right"><?=number_format($temp08);?>&nbsp;</td>
	<td align="right"><?=number_format($temp09);?>&nbsp;</td>
	<td align="right"><?=number_format($temp10);?>&nbsp;</td>
	<td align="right"><?=number_format($temp11);?>&nbsp;</td>
	<td align="right"><?=number_format($temp12);?>&nbsp;</td>
	<td align="right"><?=number_format($temp13);?>&nbsp;</td>
	<td align="right"><?=number_format($temp14);?>&nbsp;</td>
	<td align="right"><?=number_format($temp15);?>&nbsp;</td>
	<td align="right"><?=number_format($temp16);?>&nbsp;</td>
	<td align="right"><?=number_format($temp17);?>&nbsp;</td>
	<td align="right"><?=number_format($temp18);?>&nbsp;</td>
	<td align="right"><?=number_format($temp19);?>&nbsp;</td>
</tr>
</table>
</body>
</html>
<?php
	free_result($result_plan);
	close();
?>