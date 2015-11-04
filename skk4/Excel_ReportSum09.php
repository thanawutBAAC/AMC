<?php session_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="ข้อมูลแผนด้านการแปรรูปผลผลิต ด้านการซื้อ.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();

	$div = $_GET['div'];
	$year = $_GET['year'];

// แสดงข้อมูลหมวดที่ 8 ของสกต ที่เลือกทั้งหมด
$sql =" SELECT BaseReportDetail.report_detail_code, ";
$sql.=" BaseReportDetail.report_detail_name,  ";
$sql.=" BaseReportDetail.report_detail_unit,  ";
$sql.=" Temp01.Imports_unit,Temp01.Imports_price,  ";
$sql.=" Temp01.PlanTransBuy_price,Temp01.PlanTransBuy_Apr,  ";
$sql.=" Temp01.PlanTransBuy_May,Temp01.PlanTransBuy_Jun,  ";
$sql.=" Temp01.PlanTransBuy_Jul,Temp01.PlanTransBuy_Aug,  ";
$sql.=" Temp01.PlanTransBuy_Sep,Temp01.PlanTransBuy_Oct,  ";
$sql.=" Temp01.PlanTransBuy_Nov,Temp01.PlanTransBuy_Dec,  ";
$sql.=" Temp01.PlanTransBuy_Jan,Temp01.PlanTransBuy_Feb,  ";
$sql.=" Temp01.PlanTransBuy_Mar,Temp01.PlanTransBuy_Unit,  ";
$sql.=" Temp01.PlanTransBuy_Sum,Temp01.PlanTransBuy_Unit_year,  ";
$sql.=" Temp01.PlanTransBuy_Sum_year  ";
$sql.=" FROM BaseReportDetail  ";
$sql.=" LEFT JOIN (  ";
$sql.=" SELECT  ";
$sql.=" SUM(PlanTransBuy.Imports_unit) AS Imports_unit, ";
$sql.=" SUM(PlanTransBuy.Imports_price) AS Imports_price,  ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_price) AS PlanTransBuy_price, ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Apr) AS PlanTransBuy_Apr,  ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_May) AS PlanTransBuy_May, ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Jun) AS PlanTransBuy_Jun,  ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Jul) AS PlanTransBuy_Jul, ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Aug) AS PlanTransBuy_Aug,  ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Sep) AS PlanTransBuy_Sep, ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Oct) AS PlanTransBuy_Oct,  ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Nov) AS PlanTransBuy_Nov, ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Dec) AS PlanTransBuy_Dec,  ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Jan) AS PlanTransBuy_Jan, ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Feb) AS PlanTransBuy_Feb,  ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Mar) AS PlanTransBuy_Mar, ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Unit) AS PlanTransBuy_Unit,  ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Sum) AS PlanTransBuy_Sum, ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Unit_year) AS PlanTransBuy_Unit_year,  ";
$sql.=" SUM(PlanTransBuy.PlanTransBuy_Sum_year) AS PlanTransBuy_Sum_year, ";
$sql.=" report_detail_code ";
$sql.=" FROM PlanTransBuy ,userlogin ";
$sql.=" WHERE userlogin.amccode = PlanTransBuy.amccode ";
$sql.=" AND PlanTransBuy_year='".$year."' ";
$sql.=" AND userlogin.status = 'N'  ";
if($div!=0)
{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
$sql.=" GROUP BY PlanTransBuy.report_detail_code ) AS Temp01  ";
$sql.=" ON  Temp01.report_detail_code=BaseReportDetail.report_detail_code  ";
$sql.=" WHERE  ";
$sql.=" BaseReportDetail.report_group_code='8'  ";
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
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center "> ภาพรวมแผนการแปรรูปผลผลิตมาจำหน่ายของ สกต. <font color='red'>(ยอดซื้อ)</font>  แผน สก.กก4 </div>
&nbsp;
<!-- สิ้นสุดการแสดงปี -->
<table  width="1700" border='1' >
	<tr> 
		<td colspan="22" align="left">&nbsp;<font color="#0F7FAF"><b>รายละเอียดแผนการแปรรูปผลผลิตมาจำหน่ายของ สกต. ปี <?=$year; ?></b></font></td>
	</tr>
 <tr bgcolor="#33CCCC" height='20'> 
    <td rowspan="3" width="20" align="center" valign="middle">ที่</td>
    <td rowspan="3" width="300" align="center" valign="middle">ประเภทผลผลิต</td>
    <td rowspan="3" width="50" align="center" valign="middle">หน่วยนับ</td>
    <td colspan="2" align="center">ผลผลิตคงเหลือยกมาต้นปี</td>
    <td rowspan="3" width="80" align="center" valign="middle">ราคาต่อหน่วย<br>(บาท)</td>
    <td colspan="14" align="center">มูลค่าผลผลิตที่ซื้อในแต่ละเดือน ( พันบาท )</td>
    <td colspan="2" align="center">รวมผลผลิตทั้งหมดที่มีจำหน่าย</td>
  </tr>
  <tr bgcolor="#33CCCC"> 
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
  <tr bgcolor="#33CCCC" height='20'> 
    <td align="center" width="50" align="center">หน่วย</td>
    <td align="center" width="70" align="center">จำนวนเงิน</td>
  </tr>
<!--  เริ่มแสดงข้อมูล  -->
<? $i=0;
	WHILE($fetch_plan = fetch_row($result_plan)) {
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
	<td align="right"><?=number_format($fetch_plan[18]); ?></td>
	<td align="right"><?=number_format($fetch_plan[19]); ?></td>
	<td align="right"><?=number_format($fetch_plan[20]); ?></td>
	<td align="right"><?=number_format($fetch_plan[21]); ?></td>
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
	<td align="right"><?=number_format($temp16);?></td>
	<td align="right"><?=number_format($temp17);?></td>
	<td align="right"><?=number_format($temp18);?></td>
	<td align="right"><?=number_format($temp19);?></td>
</tr>
</table>
</body>
</html>
<?php
	free_result($result_plan);
	close();
?>