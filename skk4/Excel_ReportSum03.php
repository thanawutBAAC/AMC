<?php session_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="�Ҿ���������Ἱ��ҹ��èѴ���Թ��� ��ҹ��ë���.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$div = $_GET['div'];
	$year = $_GET['year'];

	connect();

// �ʴ���������Ǵ��� 2 �ͧʡ� ������͡������
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
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center "> �Ҿ���Ἱ��èѴ���Թ����Ҩ�˹��¢ͧ ʡ�. <font color='red'>(�ʹ����)</font>  Ἱ ʡ.��4 </div>
&nbsp;
<!-- ����ش����ʴ��� -->
<table  width="1700" border='1' style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="22" align="left">&nbsp;<font color="#0F7FAF"><b>��������´Ἱ��èѴ���Թ����Ҩ�˹��¢ͧ ʡ�. �� <?=$year; ?></b></font></td>
	</tr>
 <tr bgcolor='#CCFFCC' height='20'> 
    <td rowspan="3" width="20" align="center" valign="middle">���</td>
    <td rowspan="3" width="300" align="center" valign="middle">�������Թ���</td>
    <td rowspan="3" width="50" align="center" valign="middle">˹��¹Ѻ</td>
    <td colspan="2" align="center">�Թ��Ҥ������¡�ҵ鹻�</td>
    <td rowspan="3" width="80" align="center" valign="middle">�Ҥҵ��˹���<br>(�ҷ)</td>
    <td colspan="14" align="center">��Ť���Թ��ҷ������������͹ ( �ѹ�ҷ )</td>
    <td colspan="2" align="center">����Թ��ҷ���������ը�˹���</td>
  </tr>
  <tr bgcolor='#CCFFCC'> 
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
  <tr bgcolor='#CCFFCC' height='20'> 
    <td align="center" width="50" align="center">˹���</td>
    <td align="center" width="70" align="center">�ӹǹ�Թ</td>
  </tr>
<!--  ������ʴ�������  -->
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
	<td align="center" colspan="3" bgcolor='#FFFF99' height='20'><strong> ��� </strong></td>  
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