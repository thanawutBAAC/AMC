<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();

	$div = $_GET['div'];
	$year = $_GET['year'];

// �ʴ���������Ǵ��� 3 �ͧʡ� ������͡������

$sql =" SELECT BaseReportDetail.report_detail_code, ";
$sql.=" BaseReportDetail.report_detail_name,  ";
$sql.=" BaseReportDetail.report_detail_unit,  ";
$sql.=" Temp01.Imports_unit,Temp01.Imports_price,  ";
$sql.=" Temp01.PlanCollectBuy_price,Temp01.PlanCollectBuy_Apr,  ";
$sql.=" Temp01.PlanCollectBuy_May,Temp01.PlanCollectBuy_Jun,  ";
$sql.=" Temp01.PlanCollectBuy_Jul,Temp01.PlanCollectBuy_Aug,  ";
$sql.=" Temp01.PlanCollectBuy_Sep,Temp01.PlanCollectBuy_Oct,  ";
$sql.=" Temp01.PlanCollectBuy_Nov,Temp01.PlanCollectBuy_Dec,  ";
$sql.=" Temp01.PlanCollectBuy_Jan,Temp01.PlanCollectBuy_Feb,  ";
$sql.=" Temp01.PlanCollectBuy_Mar,Temp01.PlanCollectBuy_Unit,  ";
$sql.=" Temp01.PlanCollectBuy_Sum,Temp01.PlanCollectBuy_Unit_year,  ";
$sql.=" Temp01.PlanCollectBuy_Sum_year  ";
$sql.=" FROM BaseReportDetail  ";
$sql.=" LEFT JOIN (  ";
$sql.=" SELECT  ";
$sql.=" SUM(PlanCollectBuy.Imports_unit) AS Imports_unit, ";
$sql.=" SUM(PlanCollectBuy.Imports_price) AS Imports_price,  ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_price) AS PlanCollectBuy_price, ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Apr) AS PlanCollectBuy_Apr,  ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_May) AS PlanCollectBuy_May, ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Jun) AS PlanCollectBuy_Jun,  ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Jul) AS PlanCollectBuy_Jul, ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Aug) AS PlanCollectBuy_Aug,  ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Sep) AS PlanCollectBuy_Sep, ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Oct) AS PlanCollectBuy_Oct,  ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Nov) AS PlanCollectBuy_Nov, ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Dec) AS PlanCollectBuy_Dec,  ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Jan) AS PlanCollectBuy_Jan, ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Feb) AS PlanCollectBuy_Feb,  ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Mar) AS PlanCollectBuy_Mar, ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Unit) AS PlanCollectBuy_Unit,  ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Sum) AS PlanCollectBuy_Sum, ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Unit_year) AS PlanCollectBuy_Unit_year,  ";
$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Sum_year) AS PlanCollectBuy_Sum_year, ";
$sql.=" report_detail_code ";
$sql.=" FROM PlanCollectBuy ,userlogin ";
$sql.=" WHERE userlogin.amccode = PlanCollectBuy.amccode ";
$sql.=" AND PlanCollectBuy_year='".$year."' ";
$sql.=" AND userlogin.status = 'N'  ";
if($div!=0)
{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
$sql.=" GROUP BY PlanCollectBuy.report_detail_code ) AS Temp01  ";
$sql.=" ON  Temp01.report_detail_code=BaseReportDetail.report_detail_code  ";
$sql.=" WHERE  ";
$sql.=" BaseReportDetail.report_group_code='3'  ";
$sql.=" ORDER BY BaseReportDetail.report_detail_code  ";

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
<center><div class='button_print'><a href="#" onClick="window.print();return false" alt=" ����� ">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/printer.png');" class="span_icon">
<img src="../icons/printer.png" alt=" ����� " class="images_icon" > 
</span>&nbsp;�������§ҹ</a></div></center>
<br>
<div style="margin-left:auto; margin-right:auto;  text-align: center "> �Ҿ���Ἱ<u>��ë���/�Ǻ�����Ե��</u>����ɵâͧ ʡ�. <font color='red'>(�ʹ����)</font>  Ἱ ʡ.��4 </div>
<!-- ******************************************************************************************************************************************** -->
&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
	<img src="../icons/application_edit.png" alt=" ��䢢����� " class="images_icon" >
</span>&nbsp;�����Ż�
<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<table  width="1700" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="22" align="left">&nbsp;<font color="#0F7FAF"><b>��§ҹ����Ǻ�����Ե�š���ɵ� �ʹ���� ʡ�. �� <?=$year; ?></b></font></td>
	</tr>
 <tr class="rows_purple"> 
    <td rowspan="3" width="20" align="center" valign="middle">���</td>
    <td rowspan="3" width="300" align="center" valign="middle">�������Թ���</td>
    <td rowspan="3" width="50" align="center" valign="middle">˹��¹Ѻ</td>
    <td colspan="2" align="center">�Թ��Ҥ������¡�ҵ鹻�</td>
    <td rowspan="3" width="80" align="center" valign="middle">�Ҥҵ��˹���<br>(�ҷ)</td>
    <td colspan="14" align="center">��Ť���Թ��ҷ������������͹ ( �ѹ�ҷ )</td>
    <td colspan="2" align="center">����Թ��ҷ���������ը�˹���</td>
  </tr>
  <tr class="rows_purple"> 
    <td rowspan="2" width="70" align="center">�ӹǹ<br>˹���</td>
    <td rowspan="2" width="70" align="center">�ӹǹ�Թ<br>(�ѹ�ҷ)</td>
    <td rowspan="2" width="70" align="center">��.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">��.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">��.�.</td>
    <td colspan="2" align="center">���������</td>
    <td rowspan="2" width="75" align="center">��˹���<br>˹���</td>
    <td rowspan="2" width="75" align="center">�ӹǹ�Թ<br>(�ѹ�ҷ)</td>
  </tr>
  <tr class="rows_purple"> 
    <td align="center" width="50" align="center">˹���</td>
    <td align="center" width="70" align="center">�ӹǹ�Թ</td>
  </tr>
<!--  ������ʴ�������  -->
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
	<td align="right"><?=number_format($fetch_plan[18]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[19]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[20]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[21]); ?>&nbsp;</td>
	</tr>
<? // �Ҽ�����ͧ���� colume ��������͹
	 
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
	<!--  �ʴ������ŷ���������� colume -->
  <tr>
	<td align="center" colspan="3" class="rows_yellow"><strong> ��� </strong></td>  
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
<!--  ����ش��Ѻ��ا������ -->
<!-- ***************************************************************************************************************************************** -->
</table>
<br>
<center><div class='button_print'>
<a href="Excel_ReportSum05.php?year=<?=$year?>&div=<?=$div?>"><img src='../images/page_excel.gif' border='0'> ������ Excel </a></div></center>
<br>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
?>