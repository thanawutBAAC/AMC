<?php session_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="��§ҹ�Ҿ���Ἱ��û���ҳ��ä�������.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();

	// 0 �����駻����  1 2 3 4 5 6 7 8 9 ���¡Ԩ����Ң�
	$div = trim($_GET['div']);
	$year = trim($_GET['year']);

// �ʴ���������Ǵ��� 7  ������͡������
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
<div style="margin-left:auto; margin-right:auto; text-align: center "> ��������´Ἱ��� <font color='red'>��������</font> ʡ�.  </div>
<!-- ******************************************************************************************************************************************** -->
&nbsp;
<!-- ����ش����ʴ��� -->
<table  width="1260" border='1' style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr height='20'> 
		<td colspan="15" align="left">&nbsp;<font color="#0F7FAF"><b>��������´Ἱ��û���ҳ��ä������¢ͧ ʡ�. �� <?=$year; ?></b></font></td>
	</tr>
 <tr bgcolor='#99CCFF'> 
    <td rowspan="2" width="20" align="center" valign="middle">���</td>
    <td rowspan="2" width="300" align="center" valign="middle">��������������</td>
    <td colspan="12" align="center">��������������͹ (˹��� : �ҷ)</td>
    <td rowspan="2" width="100" align="center">�����������</td>
  </tr>
  <tr bgcolor='#99CCFF'> 
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
  </tr>
<!--  ������ʴ�������  -->
<? $i=0;
	WHILE($fetch_plan =  fetch_row($result_plan)) {
	$i++;

// <!--  �ʴ���������� �  -->
	if($i==1){ ?>
	<tr height='25' bgcolor='#FFCC99'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> �������´��Թ�ҹ </b></font></td>
	</tr>
<? }elseif($i==24){ ?>
	<tr height='25' bgcolor='#FFCC99'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> �������¸�áԨ�Ѵ���Թ����Ҩ�˹��� </b></font></td>
	</tr>
 <? }elseif($i==29){ ?>
	<tr height='25' bgcolor='#FFCC99'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> �������¸�áԨ�Ǻ����ż�Ե </b></font></td>
	</tr>
 <? }elseif($i==34){ ?>
	<tr height='25' bgcolor='#FFCC99'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> �������¸�áԨ���ٻ�ż�Ե��м�Ե�Թ���</b></font></td>
	</tr>
 <? }elseif($i==39){ ?>
	<tr height='25' bgcolor='#FFCC99'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> �������¸�áԨ��ԡ�� </b></font></td>
	</tr>
 <? }elseif($i==43){ ?>
	<tr height='25' bgcolor='#FFCC99'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> �������¸�áԨ�Թ���� </b></font></td>
	</tr>
 <? }  // end if 
//  ����ش����ʴ���������� � 

	if(($i%2)==0)
		echo "<tr bgcolor='#C0C0C0' height='20'>";
	else
		echo "<tr height='20'>";
?>
	<td align="right"><?=$i;?>&nbsp;</td>  
	<td align="left">&nbsp;<?=trim($fetch_plan[1]); ?></td>
	<td align="center"><?=number_format($fetch_plan[2],0,'',''); ?></td>
	<td align="center"><?=number_format($fetch_plan[3],0,'',''); ?></td>
	<td align="center"><?=number_format($fetch_plan[4],0,'',''); ?></td>
	<td align="center"><?=number_format($fetch_plan[5],0,'',''); ?></td>
	<td align="center"><?=number_format($fetch_plan[6],0,'',''); ?></td>
	<td align="center"><?=number_format($fetch_plan[7],0,'',''); ?></td>
	<td align="center"><?=number_format($fetch_plan[8],0,'',''); ?></td>
	<td align="center"><?=number_format($fetch_plan[9],0,'',''); ?></td>
	<td align="center"><?=number_format($fetch_plan[10],0,'',''); ?></td>
	<td align="center"><?=number_format($fetch_plan[11],0,'',''); ?></td>
	<td align="center"><?=number_format($fetch_plan[12],0,'',''); ?></td>
	<td align="center"><?=number_format($fetch_plan[13],0,'',''); ?></td>
	<td align="center"><?=number_format($fetch_plan[14],0,'',''); ?></td>
	</tr>
<? 
// <!--  �ʴ���������� �  -->
// �Ҽ�����ͧ���� colume ��������͹
	$temp01=$temp01+number_format($fetch_plan[2]);	
	$temp02=$temp02+number_format($fetch_plan[3]);	
	$temp03=$temp03+number_format($fetch_plan[4]);	
	$temp04=$temp04+number_format($fetch_plan[5]);	
	$temp05=$temp05+number_format($fetch_plan[6]);	
	$temp06=$temp06+number_format($fetch_plan[7]);	
	$temp07=$temp07+number_format($fetch_plan[8]);	
	$temp08=$temp08+number_format($fetch_plan[9]);	
	$temp09=$temp09+number_format($fetch_plan[10]);	
	$temp10=$temp10+number_format($fetch_plan[11]);	
	$temp11=$temp11+number_format($fetch_plan[12]);	
	$temp12=$temp12+number_format($fetch_plan[13]);	
	$temp13=$temp13+number_format($fetch_plan[14]);	
} // end while ?>

	<!--  �ʴ������ŷ���������� colume -->
  <tr>
	<td align="center" colspan="2" bgcolor='#FFFF99' height='20'> ��� </td>  
	<td align="center"><?=number_format($temp01);?></td>
	<td align="center"><?=number_format($temp02);?></td>
	<td align="center"><?=number_format($temp03);?></td>
	<td align="center"><?=number_format($temp04);?></td>
	<td align="center"><?=number_format($temp05);?></td>
	<td align="center"><?=number_format($temp06);?></td>
	<td align="center"><?=number_format($temp07);?></td>
	<td align="center"><?=number_format($temp08);?></td>
	<td align="center"><?=number_format($temp09);?></td>
	<td align="center"><?=number_format($temp10);?></td>
	<td align="center"><?=number_format($temp11);?></td>
	<td align="center"><?=number_format($temp12);?></td>
	<td align="center"><?=number_format($temp13);?></td>
	</tr>
<!--  ����ش��Ѻ��ا������ -->
<!-- ***************************************************************************************************************************************** -->
</table>
</body>
</html>
<!-- ************************** -->