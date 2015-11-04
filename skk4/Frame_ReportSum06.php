<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	
	$div = $_GET['div'];
	$year = $_GET['year'];

// แสดงข้อมูลหมวดที่ 3 ของสกต ที่เลือกทั้งหมด
$sql = " SELECT BaseReportDetail.report_detail_code, ";
$sql.=" BaseReportDetail.report_detail_name, BaseReportDetail.report_detail_unit,  ";
$sql.=" Temp01.PlanCollectSell_price,Temp01.PlanCollectSell_Apr,  ";
$sql.=" Temp01.PlanCollectSell_May,Temp01.PlanCollectSell_Jun,  ";
$sql.=" Temp01.PlanCollectSell_Jul,Temp01.PlanCollectSell_Aug,  ";
$sql.=" Temp01.PlanCollectSell_Sep,Temp01.PlanCollectSell_Oct,  ";
$sql.=" Temp01.PlanCollectSell_Nov,Temp01.PlanCollectSell_Dec,  ";
$sql.=" Temp01.PlanCollectSell_Jan,Temp01.PlanCollectSell_Feb,  ";
$sql.=" Temp01.PlanCollectSell_Mar,Temp01.PlanCollectSell_Unit,  ";
$sql.=" Temp01.PlanCollectSell_Sum  ";
$sql.=" FROM BaseReportDetail  ";
$sql.=" LEFT JOIN (  ";
$sql.=" SELECT  ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_price) AS PlanCollectSell_price, ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Apr) AS PlanCollectSell_Apr,  ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_May) AS PlanCollectSell_May, ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Jun) AS PlanCollectSell_Jun,  ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Jul) AS PlanCollectSell_Jul, ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Aug) AS PlanCollectSell_Aug,  ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Sep) AS PlanCollectSell_Sep, ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Oct) AS PlanCollectSell_Oct,  ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Nov) AS PlanCollectSell_Nov, ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Dec) AS PlanCollectSell_Dec,  ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Jan) AS PlanCollectSell_Jan, ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Feb) AS PlanCollectSell_Feb,  ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Mar) AS PlanCollectSell_Mar, ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Unit) AS PlanCollectSell_Unit,  ";
$sql.=" SUM(PlanCollectSell.PlanCollectSell_Sum) AS PlanCollectSell_Sum,  ";
$sql.=" PlanCollectSell.report_detail_code  ";
$sql.=" FROM PlanCollectSell ,userlogin ";
$sql.=" WHERE userlogin.amccode = PlanCollectSell.amccode ";
$sql.=" AND PlanCollectSell.PlanCollectSell_year='".$year."' ";
$sql.=" AND userlogin.status = 'N'  ";
if($div!=0)
{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
$sql.=" GROUP BY PlanCollectSell.report_detail_code ) AS Temp01  ";
$sql.=" ON Temp01.report_detail_code=BaseReportDetail.report_detail_code  ";

$sql.=" WHERE  BaseReportDetail.report_group_code='3'  ";
$sql.=" ORDER BY BaseReportDetail.report_detail_code  ";

$result_plan =	query($sql);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
</head>
<body>
<br>
<center><div class='button_print'><a href="#" onClick="window.print();return false" alt=" พิมพ์ ">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/printer.png');" class="span_icon">
<img src="../icons/printer.png" alt=" พิมพ์ " class="images_icon" > 
</span>&nbsp;พิมพ์รายงาน</a></div></center>
<br>
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center "> ภาพรวมแผนการรวบรวมผลผลิตการเกษตรของ สกต. <font color='red'>(ยอดขาย)</font> แผน สก.กก4 </div>
<!-- ******************************************************************************************************************************************** -->
&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
	<img src="../icons/application_edit.png" alt=" แก้ไขข้อมูล " class="images_icon" >
</span>&nbsp;ข้อมูลปี
<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<!-- สิ้นสุดการแสดงปี -->
<table  width="1440" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="18" align="left">&nbsp;<font color="#0F7FAF"><b>รายงานการรวบรวมผลิตผลการเกษตร ยอดขาย สกต. ปี <?=$year; ?></b></font></td>
	</tr>
 <tr class="rows_purple"> 
    <td rowspan="2" width="20" align="center" valign="middle">ที่</td>
    <td rowspan="2" width="300" align="center" valign="middle">ประเภทสินค้า</td>
    <td rowspan="2" width="50" align="center" valign="middle">หน่วยนับ</td>
    <td rowspan="2" width="80" align="center" valign="middle">ราคาต่อหน่วย<br>(บาท)</td>
    <td colspan="12" align="center">มูลค่าสินค้าที่ขายในแต่ละเดือน ( พันบาท )</td>
    <td colspan="2" align="center">รวมทั้งหมด</td>
  </tr>
  <tr class="rows_purple"> 
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
		echo "<tr class='rows_grey'>";
	else
		echo "<tr>";
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
	<td align="center" colspan="3" class="rows_yellow"><strong> รวม </strong></td>  
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
	</tr>
<!-- ***************************************************************************************************************************************** -->
</table>
<br>
<center><div class='button_print'>
<a href="Excel_ReportSum06.php?year=<?=$year?>&div=<?=$div?>"><img src='../images/page_excel.gif' border='0'> ข้อมูล Excel </a></div></center>
<br>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
?>