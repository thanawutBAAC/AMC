<?php session_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="������Ἱ��ҹ������ٻ�ż�Ե ��ҹ��ë���.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$amc_code = $_GET['amc_code'];
	$year = $_GET['year'];

	connect();

// �ʴ���������Ǵ��� 8 �ͧʡ� ������͡������
$sql ="	SELECT BaseReportDetail.report_detail_code,  ";
$sql.=" BaseReportDetail.report_detail_name,    ";
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
$sql.=" FROM BaseReportDetail, BaseReportHeader  ";
$sql.=" LEFT JOIN (  ";
$sql.="	SELECT   ";
$sql.="	Imports_unit,Imports_price,  ";
$sql.="	PlanTransBuy_price,PlanTransBuy_Apr,  ";
$sql.="	PlanTransBuy_May,PlanTransBuy_Jun,  ";
$sql.="	PlanTransBuy_Jul,PlanTransBuy_Aug,  ";
$sql.="	PlanTransBuy_Sep,PlanTransBuy_Oct,  ";
$sql.="	PlanTransBuy_Nov,PlanTransBuy_Dec,  ";
$sql.="	PlanTransBuy_Jan,PlanTransBuy_Feb,  ";
$sql.="	PlanTransBuy_Mar,PlanTransBuy_Unit,  ";
$sql.="	PlanTransBuy_Sum,PlanTransBuy_Unit_year,  ";
$sql.="	PlanTransBuy_Sum_year,report_detail_code,  ";
$sql.="	amccode,PlanTransBuy_year  ";
$sql.="	FROM PlanTransBuy  ";
$sql.="	WHERE amccode='".$amc_code."' AND ";
$sql.=" PlanTransBuy_year='".$year."'  "; 
$sql.=") AS Temp01   ";
$sql.=" ON Temp01.amccode = BaseReportHeader.amccode   ";
$sql.=" AND Temp01.report_detail_code=BaseReportHeader.report_detail_code   ";
$sql.=" AND Temp01.PlanTransBuy_year = '".$year."'  "; 
$sql.=" WHERE BaseReportHeader.amccode='".$amc_code."'   ";
$sql.=" AND BaseReportHeader.report_group_code='8'    ";
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
<div style="margin-left:auto; margin-right:auto;  text-align: center "> ��������´Ἱ<u>��ë���/���ٻ��Ե��</u>����ɵâͧ ʡ�. <font color='red'>(�ʹ����)</font>  Ἱ ʡ.��4 </div>
<!-- ******************************************************************************************************************************************** -->
&nbsp;
<table  width="1700" border='1'>
	<tr> 
		<td colspan="22" align="left">&nbsp;<font color="#0F7FAF"><b>��������´Ἱ������ٻ�ż�Ե�Ҩ�˹��¢ͧ ʡ�. �� <?=$year; ?></b></font></td>
	</tr>
 <tr bgcolor='#33CCCC' height='20'> 
    <td rowspan="3" width="20" align="center" valign="middle">���</td>
    <td rowspan="3" width="300" align="center" valign="middle">�������ż�Ե</td>
    <td rowspan="3" width="50" align="center" valign="middle">˹��¹Ѻ</td>
    <td colspan="2" align="center">�ż�Ե�������¡�ҵ鹻�</td>
    <td rowspan="3" width="80" align="center" valign="middle">�Ҥҵ��˹���<br>(�ҷ)</td>
    <td colspan="14" align="center">��Ť�Ҽż�Ե�������������͹ ( �ѹ�ҷ )</td>
    <td colspan="2" align="center">����ż�Ե����������ը�˹���</td>
  </tr>
  <tr bgcolor='#33CCCC' > 
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
  <tr bgcolor='#33CCCC' height='20'> 
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
	<td align="center" colspan="3" bgcolor='#FFFF99' height='20' ><strong> ��� </strong></td>  
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
<br>
</body>
</html>
<?php
	free_result($result_plan);
	close();
?>