<?php session_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="�������Ҿ���Ἱ��ҹ����Ǻ����ż�Ե ��â��.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();

	$div = $_GET['div'];
	$year = $_GET['year'];

// �ʴ���������Ǵ��� 3 �ͧʡ� ������͡������
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
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center "> ��������´Ἱ�Ҿ�������Ǻ����ż�Ե����ɵâͧ ʡ�. <font color='red'>(�ʹ���)</font> Ἱ ʡ.��4 </div>
<!-- ******************************************************************************************************************************************** -->
&nbsp;
<table  width="1440" border='1' style="margin-left:5px; margin-right:5px; margin-top:10px;">
<tr height='20'> 
	<td colspan="18" align="left">&nbsp;<font color="#0F7FAF"><b>��������´Ἱ��èѴ���Թ����Ҩ�˹��¢ͧ ʡ�. �� <?=$year; ?></b></font></td>
</tr>
 <tr bgcolor='#CC99FF' height='20'> 
    <td rowspan="2" width="20" align="center" valign="middle">���</td>
    <td rowspan="2" width="300" align="center" valign="middle">�������Թ���</td>
    <td rowspan="2" width="50" align="center" valign="middle">˹��¹Ѻ</td>
    <td rowspan="2" width="80" align="center" valign="middle">�Ҥҵ��˹���<br>(�ҷ)</td>
    <td colspan="12" align="center">��Ť���Թ��ҷ�����������͹ ( �ѹ�ҷ )</td>
    <td colspan="2" align="center">���������</td>
  </tr>
  <tr bgcolor='#CC99FF'> 
    <td width="70" align="center">��.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">��.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">��.�.</td>
    <td width="75" align="center">��˹���<br>˹���</td>
    <td width="75" align="center">�ӹǹ�Թ<br>(�ѹ�ҷ)</td>
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