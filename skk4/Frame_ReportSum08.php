<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();

	// 0 รวมทั้งประเทศ  1 2 3 4 5 6 7 8 9 ฝ่ายกิจการสาขา
	$div = trim($_GET['div']);
	$year = trim($_GET['year']);

// แสดงข้อมูลหมวดที่ 7  ที่เลือกทั้งหมด
$sql = " SELECT BaseReportDetail.report_detail_code, ";
$sql.=" BaseReportDetail.report_detail_name,  ";
$sql.=" Temp01.PlanExpenses_Apr, Temp01.PlanExpenses_May, ";
$sql.=" Temp01.PlanExpenses_Jun, Temp01.PlanExpenses_Jul, ";
$sql.=" Temp01.PlanExpenses_Aug, Temp01.PlanExpenses_Sep, ";
$sql.=" Temp01.PlanExpenses_Oct, Temp01.PlanExpenses_Nov, ";
$sql.=" Temp01.PlanExpenses_Dec, Temp01.PlanExpenses_Jan, ";
$sql.=" Temp01.PlanExpenses_Feb, Temp01.PlanExpenses_Mar,  ";
$sql.=" Temp01.PlanExpenses_Sum FROM BaseReportDetail  ";
$sql.=" 	LEFT JOIN (  ";
$sql.=" SELECT  ";
$sql.=" SUM(PlanExpenses.PlanExpenses_Apr) AS PlanExpenses_Apr,  ";
$sql.=" SUM(PlanExpenses.PlanExpenses_May) AS PlanExpenses_May, ";
$sql.=" SUM(PlanExpenses.PlanExpenses_Jun) AS PlanExpenses_Jun,  ";
$sql.=" SUM(PlanExpenses.PlanExpenses_Jul) AS PlanExpenses_Jul, ";
$sql.=" SUM(PlanExpenses.PlanExpenses_Aug) AS PlanExpenses_Aug,  ";
$sql.=" SUM(PlanExpenses.PlanExpenses_Sep) AS PlanExpenses_Sep, ";
$sql.=" SUM(PlanExpenses.PlanExpenses_Oct) AS PlanExpenses_Oct,  ";
$sql.=" SUM(PlanExpenses.PlanExpenses_Nov) AS PlanExpenses_Nov, ";
$sql.=" SUM(PlanExpenses.PlanExpenses_Dec) AS PlanExpenses_Dec,  ";
$sql.=" SUM(PlanExpenses.PlanExpenses_Jan) AS PlanExpenses_Jan, ";
$sql.=" SUM(PlanExpenses.PlanExpenses_Feb) AS PlanExpenses_Feb,  ";
$sql.=" SUM(PlanExpenses.PlanExpenses_Mar) AS PlanExpenses_Mar,  ";
$sql.=" SUM(PlanExpenses.PlanExpenses_Sum) AS PlanExpenses_Sum,  ";
$sql.=" PlanExpenses.report_detail_code ";
$sql.=" FROM PlanExpenses, userlogin ";
$sql.=" WHERE PlanExpenses.PlanExpenses_year='".$year."' ";
$sql.=" AND PlanExpenses.amccode = userlogin.amccode ";
$sql.=" AND userlogin.status = 'N' ";
if($div!=0)
{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
$sql.=" GROUP BY PlanExpenses.report_detail_code ) AS Temp01  ";
$sql.=" ON Temp01.report_detail_code=BaseReportDetail.report_detail_code  ";
$sql.=" WHERE BaseReportDetail.report_group_code='7'  ";
$sql.=" ORDER BY CAST(BaseReportDetail.report_detail_code AS INT) ";

$result_plan =	query($sql);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<br>
<center><div class='button_print'><a href='#' onClick='window.print();return false' alt=' พิมพ์ '> 
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/printer.png');" class="span_icon">
<img src="../icons/printer.png" alt=" พิมพ์ " class="images_icon" > 
</span>&nbsp;พิมพ์รายงาน</a></div></center>
<br>
<div style="margin-left:auto; margin-right:auto; text-align: center "> รายละเอียดแผนการ <font color='red'>ค่าใช้จ่าย</font> สกต.  </div>
<!-- ******************************************************************************************************************************************** -->
&nbsp;
<img src="../images/application_form.gif" border='0' alt=" ข้อมูล "  align="absmiddle" >&nbsp;ข้อมูลปี
<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<!-- สิ้นสุดการแสดงปี -->
<table  width="1260" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="15" align="left">&nbsp;<font color="#0F7FAF"><b>รายงานภาพรวมแผนการประมาณการค่าใช้จ่ายของ สกต. ปี <?=$year; ?></b></font></td>
	</tr>
 <tr class="rows_blue"> 
    <td rowspan="2" width="20" align="center" valign="middle">ที่</td>
    <td rowspan="2" width="300" align="center" valign="middle">ประเภทค่าใช้จ่าย</td>
    <td colspan="12" align="center">ค่าใช้จ่ายแต่ละเดือน (หน่วย : บาท)</td>
    <td rowspan="2" width="100" align="center">รวมค่าใช้จ่าย</td>
  </tr>
  <tr class="rows_blue"> 
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
// <!--  แสดงข้อมูลอื่น ๆ  -->
	if($i==1){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> ค่าใช้จ่ายดำเนินงาน </b></font></td>
	</tr>
<? }elseif($i==24){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> ค่าใช้จ่ายธุรกิจจัดหาสินค้ามาจำหน่าย </b></font></td>
	</tr>
 <? }elseif($i==29){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> ค่าใช้จ่ายธุรกิจรวบรวมผลผลิต </b></font></td>
	</tr>
 <? }elseif($i==34){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> ค่าใช้จ่ายธุรกิจแปรรูปผลผลิตและผลิตสินค้า</b></font></td>
	</tr>
 <? }elseif($i==39){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> ค่าใช้จ่ายธุรกิจบริการ </b></font></td>
	</tr>
 <? }elseif($i==43){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> ค่าใช้จ่ายธุรกิจสินเชื่อ </b></font></td>
	</tr>
 <? }  // end if 
//  สิ้นสุดการแสดงข้อมูลอื่น ๆ 
	if(($i%2)==0)
		echo "<tr class='rows_grey'>";
	else
		echo "<tr>";
?>
	<td align="right"><?=$i;?>&nbsp;</td>  
	<td align="left">&nbsp;<?=trim($fetch_plan[1]); ?></td>
	<td align="right"><?=number_format($fetch_plan[2]); ?>&nbsp;</td>
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
</tr>
<?
// หาผลรวมของแต่ละ colume ทั้งหมดก่อน
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
	<td align="center" colspan="2" class="rows_yellow"> รวม </td>  
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
 </tr>
<!--  สิ้นสุดปรับปรุงข้อมูล -->
<!-- ***************************************************************************************************************************************** -->
</table>
<br>
<center><div class='button_print'>
<a href="Excel_ReportSum08.php?year=<?=$year?>&div=<?=$div?>"><img src='../images/page_excel.gif' border='0'> ข้อมูล Excel </a></div></center>
<br>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
?>